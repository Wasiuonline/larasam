@extends('layouts.app')
@section('content')

<?php
/*if(!empty($id)){
if(!empty($is_admin)){
redirect("{$directory}{$admin}");
}else{
redirect("{$directory}{$users}");
}
}*/
?>

<div class="home-body-wrapper"> 
<div class="container">

<div class="col-md-4">
</div>
<div class="col-md-4">

<?php
/*$name = tp_input("name");
$email = tp_input("email");
$password = tp_input("password");
$password2 = $password;
$check_user = tp_input("check_user");

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($name) && !empty($password) && strlen($password) >= 5 && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $check_user == $_SESSION["spam_checker"]){
	
$email = strtolower($email);
$password = sha1($password);

$email_exists = in_table("email", $users_tb, "WHERE email = '{$email}'", "email");

$result = $db->select($users_tb, "WHERE email = '{$email}'", "*", "");

if(count_rows($result) > 0){

echo not_success("Email already exists. Log <a href='login/'>HERE</a> in instead.");

}else{

$data_array = array(
"name" => $name,
"email" => $email,
"password" => $password,
"date_registered" => $date_time,
"logged_in" => 1,
"date_time" => $date_time
);
$act = $db->insert($data_array, $users_tb);

$news_result = $db->select("newsletter", "WHERE email = '{$email}'", "*", "");
if(count_rows($news_result) < 1){
$newsletter_array = array(
"name" => $name,
"email" => $email,
"date_time" => $date_time
);
$db->insert($newsletter_array, "newsletter");
}

if($act){

$reg_id = in_table("id", $users_tb, "WHERE email = '$email'", "id");
$enc_email = sha1($email);

login($reg_id, $name, $email, 1);

$error = 0;

if(isset($_SESSION['prev_url']) && !empty($_SESSION['prev_url'])){
$prev_url = $_SESSION['prev_url'];
}else{
$prev_url = $directory . $users;
}

$to = "{$email}";
$subject = "Account Activation";
$message = "<p>Dear {$name},</p>
<p>Thank you for signing up for an account on {$domain}.</p>{
<p>Please confirm your registration request by following this link: <a href=\"{$directory}login/a/{$reg_id}/b/{$enc_email}/\">{$directory}login/a/{$reg_id}/b/{$enc_email}/</a></p>
<p>You may also copy and paste this link in the address bar of your browser.</p>";
$foot_note .= "<p>If you did not complete a registration form on {$domain}, it means you are getting this message in error. Please delete it. No further action is necessary.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

redirect($prev_url);

}else{
echo not_success("Error occured.");
}

}

}
*/
?>

<form action="register" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  

@csrf

<fieldset class="border-radius"><legend>Register your profile</legend>

<div>
<label for="name">Full Name<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="name" id="name" class="form-control" placeholder="Your Full Name" required value="{{ old('name') }}">
</div>
@error('name')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="email">Email<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your E-mail Address" required value="{{ old('email') }}">
</div>
@error('email')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="password">Password<span class="required">(atleast 5 characters)*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="password_confirmation">Confirm Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype Password" required value="">
</div>
@error('password_confirmation')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Register</button>
</div>

</fieldset>

</form>

<script src="{{ asset('js/general-form.js') }}"></script>

</div>

</div>
</div>

@endsection