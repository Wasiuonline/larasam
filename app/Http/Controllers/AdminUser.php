<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Newsletter;
use App\Http\Controllers\GenClass;

class AdminUser extends Controller
{
	
	public function admin_dashboard(){
	$page_slug = "index"; $title = "Admin Dashboard";
	return view('/' . GenClass::$admin . '/index', compact('title', 'page_slug'));	

	/*if(GenClass::check_privilege("make_admin_user")){
	return view('/users/index', ['title' => 'Dashboard']);	
	}else{
	return view('/errors/403', ['title' => 'Unauthorized action!']);		
	}*/
	}
	
	public function admin_profile(){
	$profile = User::find(auth()->user()->id); $page_slug = "profile"; $title = "My Profile"; $view = 1;
	return view('/' . GenClass::$admin . '/profile', compact('title', 'page_slug', 'profile', 'view'));	
	}
	public function admin_profile_pics(Request $request){
	if($request->hasFile('ufile')){
	GenClass::upload_single_image($request, "ufile", auth()->user()->id . "pic", "users", 150, 150, 1);
	return redirect('/' . GenClass::$admin . '/profile')->with('success', 'Picture successfully uploaded.');
	}
	}
	public function admin_profile_edit(User $user){
	$page_slug = "profile"; $title = "Edit My Profile"; $profile = $user; $edit = 1;
	return view('/' . GenClass::$admin . '/profile', compact('title', 'page_slug', 'profile', 'edit'));	
	}
	public function admin_profile_update(Request $request, User $user){
	$formFields = $request->validate([
	'name' => ['required', 'min:3'],
	'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
	'gender' => 'required',
	'dob' => 'required',
	'address' => 'required|min:10',
	'country' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/'
	]);	
	$user->update($formFields);
	return redirect('/' . GenClass::$admin . '/profile')->with('success', 'Account updated successfully.');
	}
	
	//////======Manage Admin=====////////
	public function manage_admin(){
	$search_fields = ['search_country', 'keyword', 'no_of_rows', 'search_start_date', 'search_end_date'];
	if(!empty(request('search'))){
	GenClass::search("manage-admin", $search_fields, 1);
	return redirect('/' . GenClass::$admin . '/manage-admin');
	}else{
	$search = GenClass::search("manage-admin", $search_fields);
	$query = User::where('admin', 1) 
	->when($search['search_country'], function($cond_req, $country){ $cond_req->where('country', '=', $country); })
	->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('id', '=', $keyword)->orWhere('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->orWhere('phone', 'LIKE', '%' . $keyword . '%'); })
	->when($search['search_start_date'], function($cond_req, $start){ $cond_req->where('date_registered', '>=', $start); })
	->when($search['search_end_date'], function($cond_req, $end){ $cond_req->where('date_registered', '<=', $end); });
	$query = GenClass::s_query($query, 20, "Manage Admin", GenClass::$admin . "/manage-admin", "manage-admin");
    return view('/' . GenClass::$admin . '/manage-admin', $query);
	}	
	}
	public function manage_admin_activities($pn2, $pn, $activities){
	$query = ActivityLog::where('user_id', $activities);
	$query = GenClass::s_query($query, 50, "View Admin Activities", GenClass::$admin . "/manage-admin/{$pn2}", "manage-admin", "/activities/{$activities}");
	$post = User::find($activities); $activities=1;	$title=$query['title']; $page_slug = "manage-admin";
	return view('/' . GenClass::$admin . '/manage-admin', compact('activities', 'post', 'query', 'title', 'pn2', 'page_slug'));	
	}
	public function manage_admin_view($pn, $view){
	$post = User::where('id',$view)->where('admin', 1)->first(); $view=1; $title="View Admin Profile"; $page_slug="manage-admin";
	return view('/' . GenClass::$admin . '/manage-admin', compact('view', 'post', 'title', 'pn', 'page_slug'));	
	}
	public function manage_admin_create(){
	$title = 'New User'; $create = 1; $page_slug = "manage-admin";
    return view('/' . GenClass::$admin . '/manage-admin', compact('create', 'title', 'page_slug'));
	}	
	public function manage_admin_edit($pn, $edit){
	$post = User::where('id',$edit)->where('admin', 1)->first();
	$pn = (isset($pn))?$pn:1; $page_slug = "manage-admin"; $title = 'Edit Project';
    return view('/' . GenClass::$admin . '/manage-admin', compact('edit', 'post', 'title', 'pn', 'page_slug'));
	}
	public function manage_admin_save(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$edit = (request('edit') != null)?request('edit'):"";
	$formFields = [
	'name' => 'required',
	'gender' => 'required',
	'dob' => 'required|date_format:Y-m-d',
	'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
	'address' => 'required',
	'country' => 'required'
	];
	if(empty($edit)){
	$formFields['email'] = ['required', Rule::unique('users', 'email')];
	$formFields["password"] = 'required|confirmed|min:5';
	}
	/*if(empty($edit)){
	$formFields['email'] = ['required', Rule::unique('users', 'email')];
	}else{
	$email = $request->email;
	$det_email = GenClass::in_table("users",[['email', '=', $email], ['id', '!=', $edit]],"id");
	$formFields['email'] = (empty($det_email))?'required':['required', Rule::unique('users', 'email')];
	}
	*/
	$formFields = $request->validate($formFields);
	if(empty($edit)){
	$formFields["admin"] = 1;
	$formFields["date_registered"] = $date_time;
	$formFields["registered_by"] = $id;
	User::create($formFields);
	}else if(!empty($edit)){
	$formFields["last_update"] = $date_time;
	$formFields["updated_by"] = $id;
	User::where('id', $edit)->where('controller', 0)->where('admin', 1)->update($formFields);
	}
	$redir_add = (!empty($edit))?"/{$pn}/view/{$edit}":"";
	return redirect('/' . GenClass::$admin . '/manage-admin' . $redir_add)->with('success', 'User saved successfully.');
	}	
	public function change_admin_password(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$reset = (request('reset') != null)?request('reset'):"";
	$formFields = $request->validate([
	'password' => 'required|confirmed|min:5'
	]);
	$formFields['password'] = bcrypt($formFields['password']);
	$formFields["last_update"] = $date_time;
	$formFields["updated_by"] = $id;
	User::where('id', $reset)->where('controller', 0)->where('admin', 1)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-admin' . "/{$pn}/view/{$reset}")->with('success', 'Password changed successfully.');
	}
	public function assign_admin_role(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$assign = (request('assign') != null)?request('assign'):"";
	$formFields = $request->validate([
	'role' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
	]);
	$formFields["last_update"] = $date_time;
	$formFields["updated_by"] = $id;
	User::where('id', $assign)->where('controller', 0)->where('admin', 1)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-admin' . "/{$pn}/view/{$assign}")->with('success', 'Role assigned successfully.');
	}
	public function remove_admin_user(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$remove = (request('remove') != null)?request('remove'):"";
	$formFields = ["admin" => 0, "last_update" => $date_time, "updated_by" => $id];
	User::where('id', $remove)->where('controller', 0)->where('admin', 1)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-admin')->with('success', 'Amin removed successfully.');
	}
	public function manage_admin_profile_pics(Request $request){
	if($request->hasFile('ufile')){
	GenClass::upload_single_image($request, "ufile", $request->member_id . "pic", "users", 150, 150, 1);
	return redirect('/' . GenClass::$admin . '/manage-admin')->with('success', 'Picture successfully uploaded.');
	}
	}
	
	/////////=======Manage Customer===//////
	public function manage_customer(){
	$search_fields = ['search_country', 'keyword', 'no_of_rows', 'search_start_date', 'search_end_date'];
	if(!empty(request('search'))){
	GenClass::search("manage-customers", $search_fields, 1);
	return redirect('/' . GenClass::$admin . '/manage-customers');
	}else{
	$search = GenClass::search("manage-customers", $search_fields);
	$query = User::where('admin', 0) 
	->when($search['search_country'], function($cond_req, $country){ $cond_req->where('country', '=', $country); })
	->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('id', '=', $keyword)->orWhere('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->orWhere('phone', 'LIKE', '%' . $keyword . '%'); })
	->when($search['search_start_date'], function($cond_req, $start){ $cond_req->where('date_registered', '>=', $start); })
	->when($search['search_end_date'], function($cond_req, $end){ $cond_req->where('date_registered', '<=', $end); });
	$query = GenClass::s_query($query, 20, "Manage Admin", GenClass::$admin . "/manage-customers", "manage-customers");
    return view('/' . GenClass::$admin . '/manage-customers', $query);
	}	
	}
	public function manage_customer_activities($pn2, $pn, $activities){
	$query = ActivityLog::where('user_id', $activities);
	$query = GenClass::s_query($query, 50, "View Admin Activities", GenClass::$admin . "/manage-customers/{$pn2}", "manage-customers", "/activities/{$activities}");
	$post = User::find($activities); $activities=1;	$title=$query['title']; $page_slug = "manage-customers";
	return view('/' . GenClass::$admin . '/manage-customers', compact('activities', 'post', 'query', 'title', 'pn2', 'page_slug'));	
	}
	public function manage_customer_view($pn, $view){
	$post = User::where('id',$view)->where('admin', 0)->first(); $view=1; $title="View Admin Profile"; 
	$page_slug = "manage-customers";
	return view('/' . GenClass::$admin . '/manage-customers', compact('view', 'post', 'title', 'pn', 'page_slug'));	
	}
	public function manage_customer_create(){
	$title = 'New User'; $create = 1; $page_slug = "manage-customers";
    return view('/' . GenClass::$admin . '/manage-customers', compact('create', 'title', 'page_slug'));
	}	
	public function manage_customer_edit($pn, $edit){
	$post = User::where('id',$edit)->where('admin', 0)->first();
	$pn = (isset($pn))?$pn:1; $page_slug = "manage-customers"; $title = 'Edit Project';
    return view('/' . GenClass::$admin . '/manage-customers', compact('edit', 'post', 'title', 'pn', 'page_slug'));
	}
	public function manage_customer_save(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$edit = (request('edit') != null)?request('edit'):"";
	$formFields = [
	'name' => 'required',
	'gender' => 'required',
	'dob' => 'required|date_format:Y-m-d',
	'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
	'address' => 'required',
	'country' => 'required'
	];
	if(empty($edit)){
	$formFields['email'] = ['required', Rule::unique('users', 'email')];
	$formFields["password"] = 'required|confirmed|min:5';
	}
	$formFields = $request->validate($formFields);
	if(empty($edit)){
	$formFields["date_registered"] = $date_time;
	$formFields["registered_by"] = $id;
	User::create($formFields);
	}else if(!empty($edit)){
	$formFields["last_update"] = $date_time;
	$formFields["updated_by"] = $id;
	User::where('id', $edit)->where('controller', 0)->where('admin', 0)->update($formFields);
	}
	$redir_add = (!empty($edit))?"/{$pn}/view/{$edit}":"";
	return redirect('/' . GenClass::$admin . '/manage-customers' . $redir_add)->with('success', 'User saved successfully.');
	}	
	public function change_customer_password(Request $request){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$pn = (request('pn') != null)?request('pn'):1;
	$reset = (request('reset') != null)?request('reset'):"";
	$formFields = $request->validate([
	'password' => 'required|confirmed|min:5'
	]);
	$formFields['password'] = bcrypt($formFields['password']);
	$formFields["last_update"] = $date_time;
	$formFields["updated_by"] = $id;
	User::where('id', $reset)->where('controller', 0)->where('admin', 0)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-customers' . "/{$pn}/view/{$reset}")->with('success', 'Password changed successfully.');
	}
	public function manage_customer_profile_pics(Request $request){
	if($request->hasFile('ufile')){
	GenClass::upload_single_image($request, "ufile", $request->member_id . "pic", "users", 150, 150, 1);
	return redirect('/' . GenClass::$admin . '/manage-customers')->with('success', 'Picture successfully uploaded.');
	}
	}
	public function make_user_admin($pn, $make_admin){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$formFields = ["admin" => 1, "last_update" => $date_time, "updated_by" => $id];
	User::where('id', $make_admin)->where('controller', 0)->where('admin', 0)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-customers')->with('success', 'User successfully made admin.');
	}
	public function activate_customer($pn, $activate){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$formFields = ["active" => 1, "last_update" => $date_time, "updated_by" => $id];
	User::where('id', $activate)->where('controller', 0)->where('admin', 0)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-customers' . "/{$pn}/view/{$activate}")->with('success', 'User successfully activated.');
	}
	public function block_customer($pn, $block){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$formFields = ["blocked" => 1, "last_update" => $date_time, "updated_by" => $id];
	User::where('id', $block)->where('controller', 0)->where('admin', 0)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-customers' . "/{$pn}/view/{$block}")->with('success', 'User successfully blocked.');
	}
	public function unblock_customer($pn, $unblock){
	$id = auth()->user()->id;
	$date_time = GenClass::gen("date_time");
	$formFields = ["blocked" => 0, "last_update" => $date_time, "updated_by" => $id];
	User::where('id', $unblock)->where('controller', 0)->where('admin', 0)->update($formFields);
	return redirect('/' . GenClass::$admin . '/manage-customers' . "/{$pn}/view/{$unblock}")->with('success', 'User successfully unblocked.');
	}
	
	/////////=======Manage Newsletter Subscribers===//////
	public function newsletter_subscribers(){
	$search_fields = ['keyword', 'no_of_rows'];
	if(!empty(request('search'))){
	GenClass::search("newsletter-subscribers", $search_fields, 1);
	return redirect('/' . GenClass::$admin . '/newsletter-subscribers');
	}else{
	$search = GenClass::search("newsletter-subscribers", $search_fields);
	$query = Newsletter::where('id', '>', 0) 
	->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%'); });
	$query = GenClass::s_query($query, 50, "Newsletter Subscribers", GenClass::$admin . "/newsletter-subscribers", "newsletter-subscribers");
    return view('/' . GenClass::$admin . '/newsletter-subscribers', $query);
	}	
	}

	/////////=======Password Update===//////
	public function reset_password(){
	$page_slug = "reset-password"; $title = 'Reset Password';
	return view('/' . GenClass::$admin . '/reset-password', compact('title', 'page_slug'));
	}
	public function update_password(Request $request, $id){
	$formFields = $request->validate([
	'password' => 'required|confirmed|min:5'
	]);	
	$formFields['password'] = bcrypt($formFields['password']);
	User::where('id', $id)->where('admin', 1)->update($formFields);
	return redirect('/' . GenClass::$admin . '/reset-password')->with('success', 'Password successfully reset.');
	}

}
