<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProjectPhoto;
use App\Models\SubProjectPhoto;
use App\Http\Controllers\GenClass; 
use Illuminate\Support\Facades\File;
use File as FileMC;

//use Illuminate\Support\Facades\DB;

class ProjectsPosts extends Controller
{
	    
	public function index(){
	//$all_posts = DB::table('project_photos')->get()-limit(8);
	$all_posts = ProjectPhoto::take(8)->get();
    return view('index', ['home_display' => $all_posts, 'title'=>'Larasamvick', 'page_slug'=>'index']);
	}
	
	public function project_photos(){
	$search_fields = ['keyword'];
	if(!empty(request('search'))){
	GenClass::search("projects-photos", $search_fields, 1);
	return redirect('/projects-photos');
	//return back()->withInput();
	}else{
	$search = GenClass::search("projects-photos", $search_fields);
	$query = ProjectPhoto::where('id', '>', 0)->when($search['keyword'], function($cond_req, $keyword){
	$cond_req->where('title', 'LIKE', '%' . $keyword . '%');
	});
	$query = GenClass::s_query($query, 8, "Project Photos", "projects-photos", "projects-photos");
    return view('projects-photos', $query);
	}
	}

	public function view_project_photos($slug){
	$post = ProjectPhoto::where('title_slug',$slug)->first(); 
	$title = GenClass::in_table("project_photos", [["title_slug", "=", $slug]], "title");
	$page_slug="project-photo-details";
	$related_posts = ProjectPhoto::where('id', '!=', $post->id)->take(8)->get();
	return view('/project-photo-details', compact('post', 'title', 'page_slug', 'related_posts'));	
	}
	
	public function manage_projects_images(){
	$search_fields = ['keyword', 'no_of_rows', 'search_start_date', 'search_end_date'];
	if(!empty(request('search'))){
	GenClass::search("manage-projects-images", $search_fields, 1);
	return redirect('/' . GenClass::$admin . '/manage-projects-images');
	}else{
	$search = GenClass::search("manage-projects-images", $search_fields);
	$query = ProjectPhoto::where('id', '>', 0) 
	->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('title', 'LIKE', '%' . $keyword . '%'); })
	->when($search['search_start_date'], function($cond_req, $start){ $cond_req->where('date_posted', '>=', $start); })
	->when($search['search_end_date'], function($cond_req, $end){ $cond_req->where('date_posted', '<=', $end); });
	$query = GenClass::s_query($query, 10, "Manage Projects Photos", GenClass::$admin . "/manage-projects-images", "manage-projects-images");
    return view('/' . GenClass::$admin . '/manage-projects-images', $query);
	}	
	}
	
	public function manage_projects_images_view($pn, $view){
	$post = ProjectPhoto::find($view); $view=1; $title="View Project Photo"; $page_slug = "manage-projects-images";
	return view('/' . GenClass::$admin . '/manage-projects-images', compact('view', 'post', 'title', 'pn', 'page_slug'));	
	}
	
	public function manage_projects_images_create(){
	$title = 'New Project'; $create = 1; $page_slug = "manage-projects-images";
    return view('/' . GenClass::$admin . '/manage-projects-images', compact('create', 'title', 'page_slug'));
	}	
	
	public function manage_projects_images_edit($pn, $edit){
	$post = ProjectPhoto::find($edit);
	$pn = (isset($pn))?$pn:1; $page_slug = "manage-projects-images"; $title = 'Edit Project';
    return view('/' . GenClass::$admin . '/manage-projects-images', compact('edit', 'post', 'title', 'pn', 'page_slug'));
	}
	
	public function manage_projects_images_save(Request $request){
	$id = auth()->user()->id;
	$rand_no = GenClass::gen("rand_no");
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$edit = (request('edit') != null)?request('edit'):"";
	$post_id = 0;

	$formFields = [
	'project_date' => 'required|date_format:Y-m-d',
	'title' => 'required',
	'location' => 'required',
	'details' => 'nullable'
	];
	if(empty($edit)){
	$formFields['title_slug'] = ['required', Rule::unique('project_photos', 'title_slug')];
	}else{
	$title_slug = $request->title_slug;
	$det_slug = GenClass::in_table("project_photos",[['title_slug', '=', $title_slug], ['id', '!=', $edit]],"id");
	$formFields['title_slug'] = (empty($det_slug))?'required':['required', Rule::unique('project_photos', 'title_slug')];
	}
	$formFields = $request->validate($formFields);	
	
	if(empty($edit) && $request->session()->has('item_img')){
	$formFields["date_posted"] = $date_time;
	$formFields["posted_by"] = $id;
	ProjectPhoto::create($formFields);
	$post_id = GenClass::in_table("project_photos",[['posted_by', '=', $id], ['date_posted', '=', $date_time]],"id");
	}else if(!empty($edit)){
	$formFields["date_updated"] = $date_time;
	$formFields["updated_by"] = $id;
	ProjectPhoto::where('id', $edit)->update($formFields);
	$post_id = $edit;
	}
	
	if($request->session()->has('item_img')){
	foreach(session("item_img") as $key => $val){
	$img1 = GenClass::det_image("items-temp/{$id}_item_displayed_{$val}_*.*", 0);
	$img2 = GenClass::det_image("items-temp/{$id}_item_featured_{$val}_*.*", 0);	
	$file_ext = explode(".",$img2);
	$file_ext = end($file_ext);
	File::move(public_path($img1), public_path("images/items-displayed/{$post_id}_{$id}_item_displayed_{$val}_{$rand_no}.{$file_ext}"));
	File::move(public_path($img2), public_path("images/items-featured/{$post_id}_{$id}_item_featured_{$val}_{$rand_no}.{$file_ext}"));
	$picture_description = session("item_img_description")[$val];
	SubProjectPhoto::create([
	"project_id" => $post_id,
	"file_session_no" => $val,
	"picture_description" => $picture_description,
	"date_posted" => $date_time,
	"posted_by" => $id
	]);
	$request->session()->forget(["item_img.{$val}", "item_img_description.{$val}"]);
	}
	}

	$redir_add = (!empty($edit))?"/{$pn}":"";
	return redirect('/' . GenClass::$admin . '/manage-projects-images' . $redir_add)->with('success', 'Project saved successfully.');
	}	
	
	public function manage_projects_images_change($pn, $change){
	$post = ProjectPhoto::find($change);
	$pn = (isset($pn))?$pn:1;  $page_slug = "manage-projects-images"; $title = 'Change Project Images';
    return view('/' . GenClass::$admin . '/manage-projects-images', compact('change', 'post', 'title', 'pn', 'page_slug'));
	}
	
	public static function delete_projects_posts(Request $request){ 
	if(!empty($request->del) && is_array($request->del)){
	$pn = $request->pn;
		
	foreach($request->del as $key => $val){
	if($val != ""){ 
	
	$data = public_path("images/items-featured/{$val}_*.*");
	$file_array = File::glob($data);
	foreach ($file_array as $filename) {
	if(file_exists($filename)){
	FileMC::delete($filename);
	}
	}
	
	$data = public_path("images/items-displayed/{$val}_*.*");
	$file_array = File::glob($data);
	foreach ($file_array as $filename) {
	if(file_exists($filename)){
	FileMC::delete($filename);
	}
	}
	
	ProjectPhoto::where('id', $val)->delete();
	SubProjectPhoto::where('project_id', $val)->delete();
	return redirect('/' . GenClass::$admin . '/manage-projects-images')->with('success', 'Project deleted successfully.');
	
	}
	}
	
	}
	}

}
