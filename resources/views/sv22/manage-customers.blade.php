<x-admin-header :title="$title" :page_slug="$page_slug"> 

<?php /* if(!isset($_REQUEST["gh"])){ include_once("../includes/admin-header.php"); 
}else{ 
include_once("../includes/gen-header.php");
require_once("../includes/resize-image.php");
} ?>

<?php
//////////=============Add New User===================///////////////////////////////////////

$activate = tr_input("activate");
$unblock = tr_input("unblock");
$block = tr_input("block");

$add = nr_input("add");
$edit = nr_input("edit");
$view = nr_input("view");
$upload = tp_input("upload");
$name = tp_input("name");
$email = tp_input("email");
$password = tp_input("password");
$password2 = $password;
$check_user = tp_input("check_user");

$conf_password = tp_input("conf_password");
$reset = tp_input("reset");

$uniq_id = "";

if(!empty($activate)){
$uniq_id = $activate;
}else if(!empty($unblock)){
$uniq_id = $unblock;
}else if(!empty($block)){
$uniq_id = $block;
}else if(!empty($reset)){
$uniq_id = $reset;
}else if(!empty($edit)){
$uniq_id = $edit;
}else if(!empty($upload)){
$uniq_id = $upload;
}

$uniq_name = (!empty($uniq_id))?get_table_data($users_tb, $uniq_id, "name"):"";
$uniq_email = (!empty($uniq_id))?get_table_data($users_tb, $uniq_id, "email"):"";

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && !empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && strlen($password) >= 5 && $check_user == $_SESSION["spam_checker"]){
	
$email = strtolower($email);
$password = sha1($password);

$result = $db->select($users_tb, "Where email = '{$email}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"name" => $name,
"email" => $email,
"password" => $password,
"date_registered" => $date_time,
"registered_by" => $id
);
$act = $db->insert($data_array, $users_tb);

$news_result = $db->select("newsletter", "Where email = '{$email}'", "*", "");
if(count_rows($news_result) < 1){
$newsletter_array = array(
"email" => $email,
"date_time" => $date_time
);
$db->insert($newsletter_array, "newsletter");
}

if($act){

$activity = "Added a new user with the email: {$email}.";
activity_log($id, $username, $user_email, $activity);

$error = 0;

$reg_id = in_table("id", $users_tb, "WHERE email = '$email'", "id");
$enc_email = sha1($email);

$to = "{$email}";
$subject = "Account Activation";
$message = "<p>Dear {$name},</p>
<p>Thank you. Your request for being registered on {$domain} has been granted and successfully acted upon.</p>
<p>Please confirm your registration request by following this link: {$directory}privates/login/a/{$reg_id}/b/{$enc_email}/</p>
<p>You may also copy and paste this link in the address bar of your browser.</p>
<p>Then you can log in to your user account with your email ({$email}) and password ({$password2})</p>";
$foot_note .= "<p>If you did not request for being registered on {$domain}, it means you are getting this message in error. Please delete it. No further action is necessary.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail(1);

echo "<div class='success'>Account successfully created.</div>";
}else{
echo "<div class='not-success'>Error occured.</div>";
}

}else{
echo "<div class='not-success'>Email already exists.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && (empty($name) or empty($email) or empty($password2) or empty($check_user))){
echo "<div class='not-success'>Not submitted! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='not-success'>Not submitted! Invalid  email format.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && !empty($password2) && strlen($password2) < 5){
echo "<div class='not-success'>Not submitted! Password must be atleast 5 characters.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && !empty($check_user) && $check_user != $_SESSION["spam_checker"]){
echo "<div class='not-success'>Not submitted! Incorrect check code.</div>";
}

////////Update User's Profile//////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($edit) && !empty($name)){

$data_array = array(
"name" => $name
);
$act = $db->update($data_array, $users_tb, "id = '$edit'");

if($act){

$activity = "Updated the profile of user " . user_id($edit) . ".";
activity_log($id, $username, $user_email, $activity);

$error = 0;

$to = "{$uniq_email}";
$subject = "Profile Update";
$message = "<p>Dear {$name},</p>
<p>This is to notify you that your profile data has been modified by an admin user - {$username} ({$user_email}).</p>
<p>Thank you.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail(1);

$user_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"inbox" => 1,
"date_time" => $date_time
);
$db->insert($user_data_array, "users_messages");

$admin_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"sent" => 1,
"date_time" => $date_time
);
$db->insert($admin_data_array, "admin_messages");

echo "<div class='success'>Profile successfully updated.</div>";
}else{
echo "<div class='not-success'>Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($edit) && empty($name)){
echo "<div class='not-success'>Not submitted! All the fields are required.</div>";
}

//////////////////////////////////=====Block Or Unblock User============//////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "GET" && (!empty($unblock) || !empty($block))){

$used_val = (!empty($unblock))?0:1;

$data_array = array(
"blocked" => $used_val
);
$act = $db->update($data_array, $users_tb, "id = '$uniq_id'");

if($act){
$activity = (!empty($unblock))?"Unblocked user #" . user_id($uniq_id) . " to gain login access.":"Blocked user #" . user_id($uniq_id) . " from logging in.";
activity_log($id, $username, $user_email, $activity);

///=====Send mail==================//
$to = "{$uniq_email}";
$subject = (!empty($unblock))?"Account Activation Notice":"Account Deactivation Notice";
$message = (!empty($block))?"<p>Dear {$uniq_name},</p><p>This is to notify you that your account has been deactivated due to some reasons. Therefore, you can not log in with your email({$uniq_email}). Kindly contact the customer service for account activation.</p>":"<p>Dear {$uniq_name},</p><p>This is to notify you that your account has been activated. Your email({$uniq_email}) has just been confirmed. You can always log in with your email ({$uniq_email}) and password.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail(1);

$user_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"inbox" => 1,
"date_time" => $date_time
);
$db->insert($user_data_array, "users_messages");

$admin_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"sent" => 1,
"date_time" => $date_time
);
$db->insert($admin_data_array, "admin_messages");
///======================================================//

echo (!empty($unblock))?"<div class='success'>User successfully enabled.</div>":"<div class='success'>User successfully disabled.</div>";
}else{
echo "<div class='not-success'>Error. Unable to process data.</div>";
}

}

//////////////////////////////////=====Activate User============//////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($activate)){

$data_array = array(
"active" => 1
);
$act = $db->update($data_array, $users_tb, "id = '$activate'");

if($act){
$activity = "Activated a user - {$uniq_name}({$uniq_email}) with ID #" . user_id($uniq_id) . ".";
activity_log($id, $username, $user_email, $activity);

///=====Send mail==================//
$to = "{$uniq_email}";
$subject = "Successful Account Activation";
$message = "<p>Dear {$uniq_name}, this is to notify you that your account has been activated. Your email ({$uniq_email}) has just been confirmed. You can always log in with your email ({$uniq_email}) and password.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail(1);

$user_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"inbox" => 1,
"date_time" => $date_time
);
$db->insert($user_data_array, "users_messages");

$admin_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"sent" => 1,
"date_time" => $date_time
);
$db->insert($admin_data_array, "admin_messages");
///======================================================//

echo "<div class='success'>User successfully activated.</div>";
}else{
echo "<div class='not-success'>Error. Unable to activate user.</div>";
}

}

/////////////=================Reset Password for User=================/////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && !empty($password) && !empty($conf_password) && $password == $conf_password && strlen($password) >= 5){

$password = sha1($password);

$data_array = array(
"password" => $password
);
$act = $db->update($data_array, $users_tb, "id = '$reset'");

if($act){

$activity = "Reset password for " . user_id($uniq_id) . ".";
activity_log($id, $username, $user_email, $activity);

$error = 0;

///=====Send mail==================//
$to = "{$uniq_email}";
$subject = "Successful Password Reset";
$message = "<p>Dear {$uniq_name}, this is to notify you that your password has been reset to <b>{$password2}</b> . You can now log in with your email ({$uniq_email}) and the new password.</p>";
$message2 = $message;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

send_mail(1);

$user_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"inbox" => 1,
"date_time" => $date_time
);
$db->insert($user_data_array, "users_messages");

$admin_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $gen_name,
"sender_email" => $gen_email,
"recipient_name" => $uniq_name,
"recipient_email" => $uniq_email,
"subject" => $subject,
"message" => $message2,
"sent" => 1,
"date_time" => $date_time
);
$db->insert($admin_data_array, "admin_messages");
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


$where = "WHERE admin = '0'";

////////////////////////////////////////////////////******************************//////////////
/*
$activities = tr_input("activities");
$table = (!empty($activities))?"activity_log":$users_tb;
$where = (!empty($activities))?"WHERE user_id = '{$activities}'":$where;
$result = $db->select($table, $where, "*", "ORDER BY id DESC");
$count = count_rows($result);

$per_view = (!empty($activities))?50:20;
if(empty($activities)){
$per_view = (!empty($no_of_rows))?$no_of_rows:$per_view;
}
$page_link = "{$admin}manage-customers/pn/";
$link_suffix = (!empty($activities))?"/activities/{$activities}/":"/";
$style_class = "general-link";
page_numbers();*/
?>

@if(isset($default))

@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; @endphp

<div class="page-title">Manage Customers ({{$display_few->count()}}) <a href="{{ $gen_class::$admin }}/manage-customers/create" class="btn gen-btn float-right"><i class="fa fa-upload" aria-hidden="true"></i> New Customer</a></div>

<form action="{{ $gen_class::$admin }}/manage-customers/profile-pics" class="img-form" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
@csrf
<input type="hidden" name="upload" value="1">                      
<input type="hidden" name="pn" value="{{$pn}}">                      
<input type="hidden" class="special-member" name="member_id" value="">                      
<input type="file" name="ufile" id="ufile" required>
</form>

<form action="{{ $gen_class::$admin }}/manage-customers" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="search" value="1" />
<div class="search-dates">
@csrf
@php $prefix = "manage-customers-" @endphp

<div class="col-md-4">
<label for="search_country">Country</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<select name="search_country" id="search_country" class="form-control js-example-basic-single">
<option value="">**Select a country**</option>
@php $results = \DB::table("users")->select('users.country as country_id', 'countries_codes.country as country_name')->distinct()->leftJoin('countries_codes', 'users.country', '=', 'countries_codes.id')->where('users.country', '>', 0)->where('users.admin', 0)->orderBy('users.country', 'asc')->get() @endphp
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
<th>Activities</th>
<th>Profile</th>
@if($gen_class::check_privilege("edit_registered_users") == 1)
<th>Action</th>
@endif
@if($gen_class::check_privilege("change_registered_users_picture") == 1)
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

$file_name = $gen_class::det_image("users/{$get_id}pic*.*", 0);

@endphp
<tr>
<td>{{$get_id}}</td>
<td><img src="{{$file_name}}" class="img-rounded"></td>
<td>{!! $name . "<br>" . $gen_class::break_long($email) !!}</td>
<th>{{ (!empty($country))?"{$country_name} ({$country_code})":"" }}</th>
<td>{{$phone}}</td>
<td>{{$status}}</td>
<td><a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/1/activities/{{$get_id}}" class="btn gen-btn" title="View {{$name}}&#039;s activities"><i class="fa fa-history" aria-hidden="true"></i> View Log</a></td>
<td><a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/view/{{$get_id}}" class="btn gen-btn" title="View {{$name}}&#039;s profile"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
@if($gen_class::check_privilege("edit_registered_users") == 1)
<td><a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/edit/{{$get_id}}" class="btn gen-btn" title="Edit {{$name}}&#039;s profile"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></td>
@endif
@if($gen_class::check_privilege("change_registered_users_picture") == 1)
<td><label for="ufile" id="{{$get_id}}" class="btn gen-btn change-picture-label" title="Change {{$name}}&#039;s profile picture. Format: .jpg, .gif, .png, .jpeg, Not more than 5MB"><i class="fa fa-upload" aria-hidden="true"></i> Change</label></td>
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
$user_id = $gen_class::user_id($get_id);
$name = $post->name;
$email = $post->email;

$file_name = $gen_class::det_image("users/{$get_id}pic*.*", 0);
@endphp

<div class="back"><a href="{{ $gen_class::$admin }}/manage-customers/{{$pn2}}" class="btn gen-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to admin users list</a></div>

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

<div class="back"><a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}" class="btn gen-btn float-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to users list</a></div>

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
$date_registered = ($post->date_registered != "0000-00-00 00:00:00")?$gen_class::full_date($post->date_registered):"";
$registered_by_id = $post->registered_by;
$registered_by_name = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"name"):"";
$registered_by_email = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"email"):"";
$registered_by = ($registered_by_id > 0)?"{$registered_by_name} ({$registered_by_email})":"Self";

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
.btn-success *{
color:#fff;
}
-->
</style>

<table class="table table-striped table-hover">
<tr><td class="gen-title" colspan="2"><img src="{{$file_name}}" class="img-rounded"></td></tr>
<tr><td style="width:175px;" class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> User ID</td><td>{{$get_id}}</td></tr>
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

@if($gen_class::check_privilege("make_admin_user"))
<a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/make-admin/{{$get_id}}" class="btn btn-success"><i class="fa fa-times" aria-hidden="true"></i> Make user admin</a>
@endif

@if($active == 0 && $gen_class::check_privilege("activate_registered_users"))
<a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/activate/{{$get_id}}" class="btn gen-btn"><i class="fa fa-check" aria-hidden="true"></i> Activate user</a> 
@endif

@if($blocked == 0 && $gen_class::check_privilege("block_registered_users"))
<a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/block/{{$get_id}}" class="btn gen-btn"><i class="fa fa-times" aria-hidden="true"></i> Block user</a> 
@endif 

@if($blocked == 1 && $gen_class::check_privilege("block_registered_users"))
<a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/unblock/{{$get_id}}" class="btn gen-btn"><i class="fa fa-check" aria-hidden="true"></i> Unblock user</a>
@endif
 
<a onClick="javascript:$('.reset-row').slideToggle();" class="btn gen-btn"><i class="fa fa-lock" aria-hidden="true"></i> Reset password <i class="fa fa-angle-down" aria-hidden="true"></i></a>

<a href="{{ $gen_class::$admin }}/manage-customers/{{$pn}}/edit/{{$get_id}}" class="btn gen-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a></td></tr>
<tr><td colspan="2">

<form action="{{ $gen_class::$admin }}/manage-customers/change-password" class="reset-row" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="width:100%; display:none;">  
<div class="gen-title">Change {{$name}}&#039;s Password</div>    
@csrf
@method('PUT')

<input type="hidden" name="reset" value="{{$get_id}}">
<input type="hidden" name="pn" value="{{$pn}}">

<div>
<label for="password">New Password<span class="required">(atleast 5 characters)*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Password to log in" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="password_confirmation">Retype Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype password" required value="">
</div>
@error('password_confirmation')
<p class="required">{{$message}}</p>
@enderror
</div>
                     
<div>
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</form>
</td></tr>
</table>

@else
<div class="not-success">This user does not exist.</div>
@endif
@endif


@if($gen_class::check_privilege("edit_admin_users") == 1 && (isset($create) || isset($edit)))

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

<div><a href="{{ $gen_class::$admin }}/manage-customers{{$back_add}}" class="btn gen-btn float-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to user&#039;s profile</a></div>

<form action="{{ $gen_class::$admin }}/manage-customers{{$url_add}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
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
<input type="text" name="name" id="name" class="form-control" placeholder="Type customer&#039;s full name" value="{{$gen_class::check_inputted('name', $name)}}" required>
</div>
@error('name')
<p class="required">{{$message}}</p>
@enderror
</div>

<div class="col-sm-6">
<label for="phone">Phone No. <span style="font-size:12px;">(without country code, e.g. 08012345678) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
<input type="text" name="phone" id="phone" class="form-control only-no" placeholder="Type customer&#039;s phone no." value="{{$gen_class::check_inputted('phone', $phone)}}" required>
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
<textarea type="text" name="address" id="address" class="form-control" rows="2" placeholder="Type customer&#039;s full address" required>{{$gen_class::check_inputted("address", $address)}}</textarea>
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
<input type="email" name="email" id="email" class="form-control" placeholder="Customer&#039;s e-mail address" required value="{{$gen_class::check_inputted("email", $email)}}">
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