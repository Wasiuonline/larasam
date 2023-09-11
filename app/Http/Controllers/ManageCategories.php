<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemsCategory;
use App\Http\Controllers\GenClass;
use Illuminate\Validation\Rule;

class ManageCategories extends Controller
{

	public function manage_categories(){
	$search_fields = ['keyword', 'no_of_rows'];
	if(!empty(request('search'))){
	GenClass::search("manage-categories", $search_fields, 1);
	return redirect('/' . GenClass::$admin . '/manage-categories');
	}else{
	$search = GenClass::search("manage-categories", $search_fields);
	$query = ItemsCategory::where('id', '>', 0) 
	->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('cat_name', 'LIKE', '%' . $keyword . '%'); });
	$query = GenClass::s_query($query, 10, "Manage Categories", GenClass::$admin . "/manage-categories", "manage-categories");
    return view('/' . GenClass::$admin . '/manage-categories', $query);
	}	
	}
	
	public function manage_categories_create(){
	$title = 'New Category'; $create = 1; $page_slug = "manage-categories";
    return view('/' . GenClass::$admin . '/manage-categories', compact('create', 'title', 'page_slug'));
	}	
	
	public function manage_categories_edit($pn, $edit){
	$post = ItemsCategory::find($edit);
	$pn = (isset($pn))?$pn:1; $page_slug = "manage-categories"; $title = 'Edit Category';
    return view('/' . GenClass::$admin . '/manage-categories', compact('edit', 'post', 'title', 'pn', 'page_slug'));
	}
	
	public function manage_categories_save(Request $request){
	$id = auth()->user()->id;
	$rand_no = GenClass::gen("rand_no");
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$edit = (request('edit') != null)?request('edit'):"";
	$post_id = 0;

	$formFields = [
	'cat_type' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
	'cat_name' => 'required',
	'cat_order' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
	'home_display' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/'
	];
	if(empty($edit)){
	$formFields['cat_slug'] = ['required', Rule::unique('items_categories', 'cat_slug')];
	}else{
	$cat_slug = $request->cat_slug;
	$det_slug = GenClass::in_table("items_categories",[['cat_slug', '=', $cat_slug], ['id', '!=', $edit]],"id");
	$formFields['cat_slug'] = (empty($det_slug))?'required':['required', Rule::unique('items_categories', 'cat_slug')];
	}
	$formFields = $request->validate($formFields);	
	
	if(empty($edit)){
	$formFields["date_posted"] = $date_time;
	$formFields["posted_by"] = $id;
	ItemsCategory::create($formFields);
	}else if(!empty($edit)){
	$formFields["date_updated"] = $date_time;
	$formFields["updated_by"] = $id;
	ItemsCategory::where('id', $edit)->update($formFields);
	}

	$redir_add = (!empty($edit))?"/{$pn}":"";
	return redirect('/' . GenClass::$admin . '/manage-categories' . $redir_add)->with('success', 'Category saved successfully.');
	}	
	
	public static function delete_items_categories(Request $request){ 
	if(!empty($request->del) && is_array($request->del)){
	$pn = $request->pn;
		
	foreach($request->del as $key => $val){
	if($val != ""){ 
	ItemsCategory::where('id', $val)->delete();
	$redir_add = (!empty($edit))?"/{$pn}":"";
	return redirect('/' . GenClass::$admin . '/manage-categories' . $redir_add)->with('success', 'Category deleted successfully.');
	}
	}
	
	}
	}

}
