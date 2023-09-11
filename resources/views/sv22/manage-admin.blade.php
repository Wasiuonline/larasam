<x-admin-header :title="$title" :page_slug="$page_slug"> 

<?php /*
role_redirect("manage_admin_users");

$pn = nr_input("pn");

$remove = nr_input("remove");

$upload = np_input("upload");
$member_id = np_input("member_id");

$add = nr_input("add");
$edit = nr_input("edit");
$view = nr_input("view");

$name = tp_input("name");
$password = tp_input("password");
$password2 = $password;
$re_password = tp_input("re_password");
$email = tp_input("email");

$address = tp_input("address");
$country = tp_input("country");
$phone = tp_input("phone");
$gender = tp_input("gender");
$dob = tp_input("dob");

$conf_password = tp_input("conf_password");
$reset = tp_input("reset");

$assign = np_input("assign");
$role = np_input("role");

$uniq_id = "";

if(!empty($assign)){
$uniq_id = $assign;
}else if(!empty($remove)){
$uniq_id = $remove;
}else if(!empty($reset)){
$uniq_id = $reset;
}else if(!empty($edit)){
$uniq_id = $edit;
}else if(!empty($member_id)){
$uniq_id = $member_id;
}

$determine_controller = in_table("controller",$users_tb,"WHERE id = '$uniq_id'","controller");

$uniq_name = (!empty($uniq_id))?in_table("name",$users_tb,"WHERE id = '$uniq_id'","name"):"";
$uniq_email = (!empty($uniq_id))?in_table("email",$users_tb,"WHERE id = '$uniq_id'","email"):"";

////////////// Upload image //////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && check_privilege("change_admin_picture") == 1 && empty($determine_controller) && !empty($upload) && !empty($member_id) && !empty($_FILES["ufile"]["tmp_name"])){ 

upload_single_image("ufile", "{$member_id}pic", "../images/users/", "250", "250");

$activity = "Updated {$uniq_name}&#039;s picture.";
activity_log($id, $username, $user_email, $activity);

$to = $uniq_email;
$subject = "Profile Picture Update";
$message = "<p>Dear {$uniq_name},</p>
<p>This is to notify you that your profile picture has been modified by an admin user - {$username} ({$user_email}).</p>
<p>Thank you.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='success'>Picture successfully updated.</div>";
}
////////////// Ends Upload image //////////////////////////////     

////////Update Admin User's Profile//////////////////////  
if($_SERVER['REQUEST_METHOD'] == "POST" && check_privilege("edit_admin_users") == 1 && empty($determine_controller) && !empty($edit) && !empty($name) && !empty($gender) && !empty($dob) && !empty($address) && !empty($country) && !empty($phone)){

$data_array = array(
"name" => $name,
"gender" => $gender,
"dob" => $dob,
"address" => $address,
"country" => $country,
"phone" => $phone
);
$act = $db->update($data_array, $users_tb, "id = '$edit'");

if($act){

$error = 0;

$activity = "Updated {$uniq_name}&#039;s profile data.";
activity_log($id, $username, $user_email, $activity);

$to = $uniq_email;
$subject = "Profile Data Update";
$message = "<p>Dear {$uniq_name},</p>
<p>This is to notify you that your profile data has been modified by an admin user - {$username} ({$user_email}).</p>
<p>Thank you.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='success'>Profile successfully updated.</div>";
}else{
echo "<div class='not-success'>Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($edit) && (empty($name) || empty($gender) || empty($dob) || empty($address) || empty($country) || empty($phone))){
echo "<div class='not-success'>Not submitted! All * the fields are required.</div>";
}

//////////////////////////////////=====Remove Admin User============//////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "GET" && check_privilege("remove_admin_user") == 1 && empty($determine_controller) && !empty($remove)){

$data_array = array(
"admin" => 0
);
$act = $db->update($data_array, $users_tb, "id = '$remove'");

if($act){

$activity = "Removed admin access from {$uniq_name}&#039;s account.";
activity_log($id, $username, $user_email, $activity);

///=====Send mail==================//
$to = $uniq_email;
$subject = "Admin Access Removal";
$message = "<p>Dear {$uniq_name},</p>
<p>This is to notify you that your account has been deactivated from admin access, by an admin user - {$username} ({$user_email}) due to official reasons.</p> 
<p>Therefore, you can not have access to the admin portal anymore.</p>
<p>Thank you.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail();
///======================================================//

echo "<div class='success'>Admin user successfully removed.</div>";
}else{
echo "<div class='not-success'>Error. Unable to remove user.</div>";
}

}

//////////////////////////////////=====Assign Role============//////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && check_privilege("assign_admin_role") == 1 && empty($determine_controller) && !empty($assign)){

$prev_role_id = in_table("role_id",$users_tb,"WHERE id = '$assign'","role_id");
$role_id_load = (!empty($role))?$role:$prev_role_id;
$role_title = get_table_data("role_management", $role_id_load, "role");

if(!empty($role_title)){

$data_array = array(
"role_id" => $role
);
$act = $db->update($data_array, $users_tb, "id = '$assign'");

if($act){

$activity = (!empty($role))?"Assigned role <b>({$role_title})</b> to {$uniq_name}.":"Removed <b>({$role_title})</b> from {$uniq_name}&#039;s account.";
activity_log($id, $username, $user_email, $activity);

///=====Send mail==================//
$to = $uniq_email;
$subject = (!empty($role))?"Role Assignment":"Role Removal";
$message = (!empty($role))?"<p>Dear {$uniq_name},</p>
<p>This is to notify you that you have been assigned a role <b>({$role_title})</b> by an admin user - {$username} ({$user_email}).</p>
<p>Thank you.</p>":"<p>Dear {$uniq_name},</p>
<p>This is to notify you that your previously assigned role <b>({$role_title})</b> has been removed from your account by an admin user - {$username} ({$user_email}).</p>
<p>Thank you.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();
///======================================================//
echo "<div class='success'>Role successfully assigned to admin user.</div>";
}else{
echo "<div class='not-success'>Error. Unable to assign role to user.</div>";
}

}else{
echo "<div class='not-success'>Not successful. No previous role assigned.</div>";
}

}

/////////////=================Reset Password for User=================/////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && check_privilege("edit_admin_users") == 1 && empty($determine_controller) && !empty($reset) && !empty($password) && !empty($conf_password) && $password == $conf_password && strlen($password) >= 5){

$password = sha1($password);

$data_array = array(
"password" => $password
);
$act = $db->update($data_array, $users_tb, "id = '$reset'");

if($act){

$error = 0;

$activity = "Reset {$uniq_name}&#039;s password.";
activity_log($id, $username, $user_email, $activity);

///=====Send mail==================//
$to = "{$uniq_email}";
$subject = "Successful Password Reset";
$message = "<p>Dear {$uniq_name}, this is to notify you that your password has been reset to <b>{$password2}</b> by an admin user - {$username} ({$user_email}). You can now log in with your email ({$uniq_email}) and the new password.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail();
///======================================================//

echo "<div class='success'>Password successfully updated for {$uniq_name} ({$uniq_email}).</div>";
}else{
echo "<div class='not-success'>Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && (empty($password2) or empty($conf_password))){
echo "<div class='not-success'>Not updated! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && !empty($password2) && $password2 != $conf_password){
echo "<div class='not-success'>Not updated! Passwords do not match.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && !empty($password2) && strlen($password2) < 5){
echo "<div class='not-success'>Not updated! Password must be at least 5 digits.</div>";
}

////////////////////////////////////////////////////******************************//////////////
/*
$search_user_category = search_option("search_user_category");
$search_country = search_option("search_country");
$keyword = search_option("keyword");
$no_of_rows = search_option("no_of_rows");

$where = "WHERE id > '0' AND admin = '1'";
$where .= (!empty($search_country))?" AND country = '$search_country'":"";
$where .= (!empty($keyword))?" AND (id = '{$keyword}' OR name LIKE '%{$keyword}%' OR email LIKE '%{$keyword}%' OR phone = '{$keyword}')":"";

$activities = nr_input("activities");
$table = (!empty($activities))?"activity_log":$users_tb;
$where = (!empty($activities))?"WHERE user_id = '{$activities}'":$where;
$order_by = "id";
$result = $db->select($table, $where, "*", "ORDER BY $order_by DESC");
$count = count_rows($result);

$per_view = (!empty($activities))?50:20;
$per_view = (!empty($no_of_rows) && empty($activities))?$no_of_rows:$per_view;
$page_link = "{$admin}manage-admin/pn/";
$link_suffix = (!empty($activities))?"/activities/{$activities}/":"/";
$style_class = "general-link";
page_numbers();

$offset = ($per_view * $pn) - $per_view;

$result = $db->select($table, $where, "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");

if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])){
echo $_SESSION["msg"];
unset($_SESSION["msg"]);
}
*/
?>

@if(isset($default))

@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; @endphp

<div class="page-title">Manage Admin Users ({{$display_few->count()}}) <a href="{{ $gen_class::$admin }}/manage-admin/create" class="btn gen-btn float-right">New User</a></div>

<form action="{{ $gen_class::$admin }}/manage-admin/profile-pics" class="img-form" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
@csrf
<input type="hidden" name="upload" value="1">                      
<input type="hidden" name="pn" value="{{$pn}}">                      
<input type="hidden" class="special-member" name="member_id" value="">                      
<input type="file" name="ufile" id="ufile" required>
</form>

<form action="{{ $gen_class::$admin }}/manage-admin" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="search" value="1" />
<div class="search-dates">
@csrf
@php $prefix = "manage-admin-" @endphp

<div class="col-md-4">
<label for="search_country">Country</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<select name="search_country" id="search_country" class="form-control js-example-basic-single">
<option value="">**Select a country**</option>
@php $results = \DB::table("users")->select('users.country as country_id', 'countries_codes.country as country_name')->distinct()->leftJoin('countries_codes', 'users.country', '=', 'countries_codes.id')->where('users.country', '>', 0)->where('users.admin', 1)->orderBy('users.country', 'asc')->get() @endphp
@if($results->count() > 0)
@foreach($results  as $result)
<option value="{{$result->country_id}}" {{$gen_class::check_selected('search_country', $result->country_id, session($prefix.'search_country'))}}>{{$result->country_name}}</option>
@endforeach
@endif
</select> 
</div>
</div>

<div class="col-md-4">
<label for="keyword">Keyword</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="keyword" id="keyword" class="form-control" placeholder="User ID, Name, Email or Phone No." value="{{ session($prefix.'keyword') }}">
</div>
</div>

<div class="col-md-4">
<label for="no_of_rows">No. of Rows</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
<input type="number" name="no_of_rows" id="no_of_rows" class="form-control only-no" placeholder="No. of rows" value="{{ $gen_class::$per_view }}">
</div>
</div>

<div class="col-md-5">
<label for="search_start_date">Start Date</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="search_start_date" id="search_start_date" class="form-control gen-date" placeholder="YYYY-MM-DD" value="{{ session($prefix.'search_start_date') }}">
</div>
</div>

<div class="col-md-5">
<label for="search_end_date">End Date</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="search_end_date" id="search_end_date" class="form-control gen-date" placeholder="YYYY-MM-DD" value="{{ session($prefix.'search_end_date') }}">
</div>
</div>

<div class="col-md-2">
<br />
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-search"></i> Search</button>
</div>

</div>
</form>

@if($gen_class::$count > 0)

<div class="overflow">
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>#ID</th>
<th style="width:50px">Picture</th>
<th>Details</th>
<th>Country</th>
<th>Phone</th>
<th>Status</th>
<th>Role</th>
<th>Activities</th>
<th>Profile</th>
@if($gen_class::check_privilege("edit_admin_users") == 1)
<th>Action</th>
@endif
@if($gen_class::check_privilege("change_admin_picture") == 1)
<th>Image</th>
@endif
</tr>
</thead>
<tbody>
@foreach($display_few as $post)
@php
$get_id = $post->id;
$name = $post->name;
$email = $post->email;
$country = $post->country;
$country_name = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"country"):"";
$country_code = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"code"):"";
$phone = $post->phone;
$active = $post->active;
$blocked = $post->blocked;
$status = "";
if($blocked == 1){
$status = "Blocked";
}else if($active == 1){
$status = "Active";
}else if($active == 0){
$status = "Not active";
}

$is_controller = $post->controller;
$role_id = $post->role_id;
$role_assigned = (!empty($role_id))?"<span style=\"font-weight:bold;\">" . $gen_class::in_table("role_management",[['id', '=', $role_id]],"role") . "</span>":"<span style=\"color: #b20; font-weight:bold;\">Not Assigned</span>";
$role_assigned = (!empty($is_controller))?"<span style=\"color:#2387a0; font-weight:bold;\">SUPER ADMIN</span>":$role_assigned;

$file_name = $gen_class::det_image("users/{$get_id}pic*.*", 0);

@endphp
<tr>
<td>{{$get_id}}</td>
<td><img src="{{$file_name}}" class="img-rounded"></td>
<td>{!! $name . "<br>" . $gen_class::break_long($email) !!}</td>
<th>{{ (!empty($country))?"{$country_name} ({$country_code})":"" }}</th>
<td>{{$phone}}</td>
<td>{{$status}}</td>
<td>{!!$role_assigned!!}</td>
<td><a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}/1/activities/{{$get_id}}" class="btn gen-btn" title="View {{$name}}&#039;s activities"><i class="fa fa-history" aria-hidden="true"></i> View Log</a></td>
<td><a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}/view/{{$get_id}}" class="btn gen-btn" title="View {{$name}}&#039;s profile"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
@if($gen_class::check_privilege("edit_admin_users") == 1)
<td>
@if(empty($is_controller))
<a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}/edit/{{$get_id}}" class="btn gen-btn" title="Edit {{$name}}&#039;s profile"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
@endif
</td>
@endif
@if($gen_class::check_privilege("change_admin_picture") == 1)
<td>
@if(empty($is_controller))
<label for="ufile" id="{{$get_id}}" class="btn gen-btn change-picture-label" title="Change {{$name}}&#039;s profile picture. Format: .jpg, .gif, .png, .jpeg, Not more than 5MB"><i class="fa fa-upload" aria-hidden="true"></i> Change</label>
@endif
</td>
@endif
</tr>

@endforeach
</tbody>
</table>
</div>

{!! ($gen_class::$last_page>1)?"<div class=\"page-nos\">" . $gen_class::$center_pages . "</div>":"" !!}

@else
<div class="not-success">No users found.</div>
@endif

@endif


@if(isset($activities))
@if($post)
@php
$get_id = $post->id;
$user_id = $gen_class::admin_id($get_id);
$name = $post->name;
$email = $post->email;
$file_name = $gen_class::det_image("users/{$get_id}pic*.*", 0);
@endphp

<div class="back"><a href="{{ $gen_class::$admin }}/manage-admin/{{$pn2}}" class="btn gen-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to admin users list</a></div>

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
-->
</style>
@if($gen_class::$count > 0)
<div class="overflow">
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th style="width:80px">{{$user_id}}</th>
<th style="width:130px"><img src="{{$file_name}}" class="img-rounded"></th>
<th>{{"{$name} ({$email})"}}</th>
</tr>
<tr>
<th colspan="2" class="center"><b>Date and Time</b></th>
<th><b>Activities</b></th>
</tr>
</thead>
<tbody>
@foreach($query['display_few'] as $result)
@php
$activity = $result->activity;
$activity_date = $gen_class::min_full_date($result->date_time);
@endphp
<tr>
<td colspan="2" class="center">{{$activity_date}}</td>
<td>{{$activity}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

{!! ($gen_class::$last_page>1)?"<div class=\"page-nos\">" . $gen_class::$center_pages . "</div>":"" !!}

@else
<div class="not-success">No activities found for {{$name}} ({{$email}}).</div>
@endif

@else
<div class="not-success">This user is not found.</div>
@endif

@endif


@if(isset($view))
@if($post)

<div class="back"><a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}" class="btn gen-btn float-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to users list</a></div>

@php
$get_id = $post->id;
$name = $post->name;
$gender = $post->gender;
$dob = ($post->dob != "0000-00-00")?$gen_class::sub_date($post->dob):"";
$email = $post->email;
$address = $post->address;
$country = $post->country;
$country_name = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"country"):"";
$country_code = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"code"):"";
$address = (!empty($address) && !empty($country_name))?"{$address}, {$country_name}":"";
$phone = $post->phone;
$is_controller = $post->controller;
$date_registered = ($post->date_registered != "0000-00-00 00:00:00")?$gen_class::full_date($post->date_registered):"";
$registered_by_id = $post->registered_by;
$registered_by_name = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"name"):"";
$registered_by_email = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"email"):"";
$registered_by = ($registered_by_id > 0)?"{$registered_by_name} ({$registered_by_email})":"Self";

$is_controller = $post->controller;
$role_id = $post->role_id;
$role_assigned = (!empty($role_id))?"<span class=\"btn btn-success\">" . $gen_class::in_table("role_management",[['id', '=', $role_id]],"role") . "</span>":"<span class=\"btn btn-danger\">Not Assigned</span>";
$role_assigned = (!empty($is_controller))?"<span class=\"btn btn-primary\">SUPER ADMIN</span>":$role_assigned;

$logged_in = ($post->logged_in == 1)?"Yes":"No";
$active = $post->active;
$blocked = $post->blocked;
$status = "";
if($blocked == 1){
$status = "Blocked";
}else if($active == 1){
$status = "Active";
}else if($active == 0){
$status = "Not active";
}

$date_time = ($post->date_time != "0000-00-00 00:00:00")?$gen_class::full_date($post->date_time):"Never logged in";
$last_login = ($post->last_login != "0000-00-00 00:00:00")?$gen_class::full_date($post->last_login):"Not Available";

$file_name = $gen_class::det_image("users/{$get_id}pic*.*", 0);
@endphp

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
.reset-row1, .reset-row2{
display:none;
}
.btn{
margin-bottom:5px;
margin-right:5px;
}
-->
</style>

<table class="table table-striped table-hover">
<tr><td class="gen-title" colspan="2"><img src="{{$file_name}}" class="img-rounded"></td></tr>
<tr><td style="width:175px;" class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> User ID</td><td>{{$get_id}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Role</td><td>{!!$role_assigned!!}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Full Name</td><td>{{$name}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-envelope" aria-hidden="true"></i> Email</td><td>{{$email}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</td><td>{{$address}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-code" aria-hidden="true"></i> Country Code</td><td>{{$country_code}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-phone" aria-hidden="true"></i> Telephone</td><td>{{$phone}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Gender</td><td>{{$gender}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Date of Birth</td><td>{{$dob}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Date Registered</td><td>{{$date_registered}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Registered by</td><td>{{$registered_by}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-sign-in" aria-hidden="true"></i> Logged In</td><td>{{$logged_in}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Last Login</td><td>{{$last_login}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Current Login</td><td>{{$date_time}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Account Status</td><td>{{$status}}</td></tr>

<tr><td class="gen-title"><i class="fa fa-cog" aria-hidden="true"></i> Action</td><td>

@if($gen_class::check_privilege("remove_admin_user") == 1 && empty($is_controller))
<a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}/remove/{{$get_id}}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Remove user</a>
@endif

@if($gen_class::check_privilege("assign_admin_role") == 1 && empty($is_controller))
<a onclick="javascript: $('.reset-row1').hide(); $('.reset-row2').slideToggle();" class="btn gen-btn"><i class="fa fa-user" aria-hidden="true"></i> Assign a role <i class="fa fa-angle-down" aria-hidden="true"></i></a>
@endif

@if($gen_class::check_privilege("edit_admin_users") == 1 && empty($is_controller))
<a onclick="javascript: $('.reset-row2').hide(); $('.reset-row1').slideToggle();" class="btn gen-btn"><i class="fa fa-lock" aria-hidden="true"></i> Reset password <i class="fa fa-angle-down" aria-hidden="true"></i></a>
<a href="{{ $gen_class::$admin }}/manage-admin/{{$pn}}/edit/{{$get_id}}" class="btn gen-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>
@endif

</td></tr>
<tr><td colspan="2">

@if($gen_class::check_privilege("edit_admin_users") == 1 && empty($is_controller))

<div class="reset-row reset-row1">
<form action="{{ $gen_class::$admin }}/manage-admin/change-password" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="width:100%;">  
<div class="gen-title">Change {{$name}}&#039;s Password</div>    
@csrf
@method('PUT')

<input type="hidden" name="reset" value="{{$get_id}}">
<input type="hidden" name="pn" value="{{$pn}}">

<div>
<label for="password">New Password (atleast 5 characters)</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Password to log in" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="password_confirmation">Retype Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype password" required value="">
</div>
@error('password_confirmation')
<p class="required">{{$message}}</p>
@enderror
</div>
                     
<div class="submit-div">
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</form>
</div>

@endif
@if($gen_class::check_privilege("assign_admin_role") == 1 && empty($is_controller))

<div class="reset-row reset-row2">
<form action="{{ $gen_class::$admin }}/manage-admin/assign-role" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="width:100%;">  
<div class="gen-title">Assign a role to {{$name}}</div>    
@csrf
@method('PUT')

<input type="hidden" name="assign" value="{{$get_id}}">
<input type="hidden" name="pn" value="{{$pn}}">

<div>
<label for="role">Role</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<select name="role" id="role" class="form-control" required>
<option value="0">**Select a role**</option>
@php $results = \DB::table("role_management")->orderBy('role', 'asc')->get() @endphp
@if($results->count() > 0)
@foreach($results  as $result)
<option value="{{$result->id}}" {{$gen_class::check_selected('role', $result->id, $role_id)}}>{{$result->role}}</option>
@endforeach
@endif
</select> 
</div>
@error('role')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="submit-div">
<button class="btn gen-btn float-right"><i class="fa fa-check"></i> Assign</button>
</div>

</form>
</div>

@endif

</td></tr>
</table>

@else
<div class="not-success">This user does not exist.</div>
@endif
@endif


@if(($gen_class::check_privilege("edit_admin_users") == 1 && isset($create)) || isset($edit))

@php $name = $email = $gender = $dob = $address = $country = $phone = ""; @endphp
@if(isset($edit))
@if($post)
@php 
$name = $post->name;
$email = $post->email;
$gender = $post->gender;
$dob = $post->dob;
$dob = ($dob != "0000-00-00")?$dob:"";
$address = $post->address;
$country = $post->country;
$phone = $post->phone;
@endphp
@endif
@endif

@php
$url_add = (!empty($edit))?"/{$pn}/edit/{$edit}":"/create";
$back_add = (!empty($edit))?"/{$pn}":"";
$action_title = (!empty($edit))?"Edit Profile for {$name} ({$email})":"Add New Profile";
@endphp

<div><a href="{{ $gen_class::$admin }}/manage-admin{{$back_add}}" class="btn gen-btn float-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to user&#039;s profile</a></div>

<form action="{{ $gen_class::$admin }}/manage-admin{{$url_add}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<div class="body-header">{{$action_title}}</span></div>    

<div class="required">All * fields are required.</div>

@csrf

@if(isset($edit))
@method('PUT')
<input type="hidden" name="edit" value="{{$edit}}"> 
<input type="hidden" name="pn" value="{{$pn}}"> 
@endif

<div class="col-sm-6">
<label for="name">Full Name <span style="font-size:12px;">(separated with space and surname first) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="name" id="name" class="form-control" placeholder="Type user&#039;s full name" value="{{$gen_class::check_inputted('name', $name)}}" required>
</div>
@error('name')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="phone">Phone No. <span style="font-size:12px;">(without country code, e.g. 08012345678) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
<input type="text" name="phone" id="phone" class="form-control only-no" placeholder="Type user&#039;s phone no." value="{{$gen_class::check_inputted('phone', $phone)}}" required>
</div>
@error('phone')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="dob">Date of Birth<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="dob" id="dob" class="form-control gen-date" onfocus="javascript: $(this).blur();" placeholder="YYYY-MM-DD" value="{{$gen_class::check_inputted('dob', $dob)}}" required>
</div>
@error('dob')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="gender">Gender<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<select name="gender" id="gender" class="form-control js-example-basic-single" required>
<option value="">**Select your gender**</option>
<option value="Male" {{$gen_class::check_selected("gender", "Male", $gender)}}>Male</option>
<option value="Female" {{$gen_class::check_selected("gender", "Female", $gender)}}>Female</option>
</select> 
</div>
@error('gender')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-12">
<label for="address">Residential Address <span style="font-size:12px;">(street no. and name, region/local gov't, state) *</span></label>
<div class="form-group input-group"> 
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<textarea type="text" name="address" id="address" class="form-control" rows="2" placeholder="Type user&#039;s full address" required>{{$gen_class::check_inputted("address", $address)}}</textarea>
</div>
@error('address')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="country">Country<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<select name="country" id="country" class="form-control js-example-basic-single" required>
<option value="">**Select a country**</option>
@php $results = \DB::table("countries_codes")->orderBy('country', 'asc')->get() @endphp
@if($results->count() > 0)
@foreach($results  as $result)
<option value="{{$result->id}}" {{$gen_class::check_selected('country', $result->id, $country)}}>{{$result->country}}</option>
@endforeach
@endif
</select> 
</div>
@error('country')
<p class="required">{{$message}}</p>
@enderror
</div>

@if(isset($create))

<div class="col-sm-6">
<label for="email">Email<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="User&#8358;s e-mail address" required value="{{$gen_class::check_inputted("email", $email)}}">
</div>
@error('email')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="password">Password<span class="required">(atleast 5 characters) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Password for login" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="password_confirmation">Confirm Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype password" required value="">
</div>
@error('password_confirmation')
<p class="required">{{$message}}</p>
@enderror
</div>

@endif

<div class="col-sm-{{ (isset($edit))?'6':'12'; }} submit-div">
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Save</button>
</div>
</form>

@endif

<script src="{{ asset('js/general-form.js') }}"></script>

</div>
</div>

</div>

</x-admin-header> 