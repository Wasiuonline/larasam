@auth
redirect('/users')
@endauth

@extends('layouts.app')
@section('content')

<div class="home-body-wrapper"> 
<div class="container">

<div class="col-sm-3">
</div>
<div class="col-sm-6">

<?php 
/*

// Reset Password
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["reset"]) && !empty($email)){

$result = $db->select($users_tb, "WHERE email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);
$name = $row["name"];
$email = $row["email"];
$reg_id = $row["id"];
$password = $row["password"];
$blocked = $row["blocked"];

if($blocked == 0){

$to = "{$email}";
$subject = "Password Reset";
$message = "<p>Dear {$name},</p>
<p>You have successfully reset your password.</p>
<p>Kindly update your new password by clicking on, or copying and pasting this link on your address bar: <a href=\"{$directory}login/a2/{$reg_id}/b2/{$password}/\">{$directory}login/a2/{$reg_id}/b2/{$password}/</a></p>";
$foot_note .= "<p>If you did not request for password reset, kindly ignore this mail.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo success("Successfully. Kindly check your mail for the next procedure.");
$error = 0;
}else if($blocked == 1){
echo not_success("Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>");
}

}else{
echo not_success("This email is not registered. Kindly register <a href='register/'>HERE</a>");
}

}

////////////////////////////////////////////////////
if(!empty($a) && !empty($b)){
$result = $db->select($users_tb, "WHERE id = '{$a}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$enc_email = sha1($row["email"]);
$active = $row["active"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo not_success("Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.");
}else if($enc_email == $b && $active == 0){
$fid = $db->query("UPDATE {$users_tb} SET active = '1' WHERE id = '{$a}'");
if($fid){
echo success("Congrat {$name}! Your account is now activated. Kindly log in.");
}
}else if($enc_email == $b && $active == 1){
echo not_success("Hi {$name}! Your account was previously activated. Kindly log in.");
}else if($enc_email != $b){
echo not_success("Invalid request.");
}

}else{
echo not_success("Invalid request.");
}

}

///////////////////////////////New Password////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($a2) && !empty($b2) && !empty($password) && !empty($conf_pass) && strlen($password) >= 5 && $password == $conf_pass ){

$new_password = sha1($password);
$user_email = in_table("email",$users_tb,"WHERE id='{$a2}'","email");

$result = $db->select($users_tb, "WHERE id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo not_success("Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.");
}else if($password2 == $b2){

$data_array = array(
"password" => $new_password
);
$act = $db->update($data_array, $users_tb, "id = '{$a2}'");

if($act){
$activity = "Reset own password.";
activity_log($a2, $name, $user_email, $activity);

$_SESSION["msg"] = success("Password successfully updated. Kindly log in with your new password.");
redirect("{$directory}login/");
}else{
echo not_success("Error occured.");
}

}else if($password2 != $b2){
echo not_success("Invalid request.");
}

}else{
echo not_success("Invalid request.");
}

}


///////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && (empty($password2) or empty($conf_pass))){
$_SESSION["notSuccess"] = not_success("Not submitted! All the fields are required.");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($password2) && strlen($password2) < 5){
$_SESSION["notSuccess"] = not_success("Not submitted! Password must be atleast 5 characters.");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"]) && !empty($password2) && $password2 != $conf_pass){
$_SESSION["notSuccess"] = not_success("Not submitted! Passwords do not match.");
}
/////////////////////////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["login"]) && (empty($email) or empty($password2))){
echo not_success("All the feilds are required.");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["login"]) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo not_success("Not submitted! Invalid  email format.");
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["reset"]) && empty($email)){
echo not_success("Email is required.");
}

if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"]) && empty($password) && empty($email) && empty($a2)){
echo $_SESSION["msg"];
$_SESSION["msg"] = NULL;
unset($_SESSION["msg"]);
session_destroy();
}
if(isset($_SESSION["msg2"]) && !empty($_SESSION["msg2"])){
echo $_SESSION["msg2"];
$_SESSION["msg2"] = NULL;
unset($_SESSION["msg2"]);
}
*/
if(!isset($_REQUEST["a2"]) && !isset($_REQUEST["b2"])){
?>
<form action="login" class="login-form login-form2" method="post" enctype="multipart/form-data">  
<fieldset class="border-radius"><legend>Login</legend>
@csrf

<div>
<label for="email">Email<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Username" required value="{{ old('email') }}">
</div>
@error('email')
<p class="required">{{$message}}</p>
@enderror
</div>

<div>
<label for="password">Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>
                     
<div>
<a class="toggle-forms form-link" style="color:#b20;" onclick="javascript:$('.login-form2').slideToggle();$('.forgot-form2').slideToggle();">Forgot Password?</a>
<button class="gen-btn float-right"><i class="fa fa-sign-in"></i> Login</button>
</div>

<a href="register" style="color:#090; font-weight:900;" class="form-link">If not registered, kindly click here.</a>
</fieldset>
</form>

<form action="login" class="forgot-form forgot-form2" style="display:none;" method="post" enctype="multipart/form-data">  
<fieldset class="border-radius"><legend>Change Your Password</legend>
@csrf
<input type="hidden" name="reset" value="1">

<div>
<label for="email">Email<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Username" required value="{{ old('email') }}">
</div>
</div>
                     
<div>
<a class="toggle-forms form-link" style="color:#b20;" onclick="javascript:$('.forgot-form2').slideToggle();$('.login-form2').slideToggle();">Login</a>
<button class="gen-btn float-right"><i class="fa fa-lock"></i> Reset Password</button>
</div>
</fieldset>
</form>

<?php  
}

/*if(isset($_REQUEST["a2"]) && isset($_REQUEST["b2"])){

$result = $db->select($users_tb, "WHERE id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo not_success("Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.");
}else if($password2 == $b2){
?>
 
<form action="login/" class="reset-form general-form" id="form-div" method="post" enctype="multipart/form-data">  
<fieldset class="border-radius"><legend>Hi <?php echo $name; ?>, Your New Password</legend>

<input type="hidden" name="a2" id="a2" required value="<?php echo $a2; ?>">
<input type="hidden" name="b2" id="b2" required value="<?php echo $b2; ?>">
<input type="hidden" name="update" value="1">

<div>
<label for="password">New Password<span class="required">(atleast 5 characters)*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password for login" required value="<?php check_inputted("password"); ?>">
</div>
</div>

<div>
<label for="conf_pass">Retype Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Retype your password" required value="<?php check_inputted("conf_pass"); ?>">
</div>
</div> 
                     
<div>
<button class="gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</fieldset>
</form>

<?php  
}else if($password2 != $b2){
echo not_success("Invalid request.");
}

}else{
echo not_success("Invalid request.");
}

}*/
?>

<script src="{{asset('js/general-form.js')}}"></script>

</div>
</div>
</div>

@endsection