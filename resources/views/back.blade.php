<?php
if(!isset($_REQUEST["gh"])){ 
require_once("includes/header.php");
}else{ 
require_once("includes/gen-header.php");
}
 
if(!empty($id)){
redirect("{$directory}{$users}");
}
?>
<link type="text/css" rel="stylesheet" href="css/special-form.css" />

<div class="home-body-wrapper"> 
<div class="container">

<div class="col-sm-3">
</div>
<div class="col-sm-6 subscribe">

<?php 
$wait = "";
$email = tp_input("email");
$password = tp_input("password");
$password2 = $password;
$conf_pass = tp_input("conf_pass");
$keep_me = np_input("keep_me");
$a = nr_input("a");
$b = tr_input("b");
$a2 = nr_input("a2");
$b2 = tr_input("b2");

$login = np_input("login");
$reset = np_input("reset");
$update = np_input("update");

$prev_url = np_input("prev_url");

// Login
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($login) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)){

$password = sha1($password);

$result = $db->select($users_tb, "Where email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);

if($row["password"] == $password && $row["blocked"] == 0){
$name = $row["name"];
$email = $row["email"];
$id = $row["id"];

login($id, $name, $email, 1);

$error = 0;

if(isset($_SESSION['prev_url']) && !empty($_SESSION['prev_url'])){
$prev_url = $_SESSION['prev_url'];
}else{
$prev_url = $directory . $admin;
}

redirect($prev_url);

}else if($row["password"] != $password && $row["blocked"] == 0){
echo "<div class='not-success'>Incorrect Password</div>";
}else if($row["blocked"] == 1){
echo "<div class='not-success'>Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a></div>";
}

}else{
echo "<div class='not-success'>Not successful. This email is not registered.</div>";
}

}

// Reset Password
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && !empty($email)){

$result = $db->select($users_tb, "Where email = '{$email}'", "*", "");

if(count_rows($result) == 1){

$row = fetch_data($result);
$name = $row["name"];
$email = $row["email"];
$reg_id = $row["id"];
$password = $row["password"];
$blocked = $row["blocked"];

if($blocked == 0){

$to = $email;
$subject = "Password Reset";
$message = "<p>Dear {$name},</p>
<p>You have successfully reset your password.</p>
<p>Kindly update your new password by clicking on, or copying and pasting this link on your address bar: <a href=\"{$directory}back/a2/{$reg_id}/b2/{$password}/\">{$directory}back/a2/{$reg_id}/b2/{$password}/</a></p>";
$foot_note .= "<p>If you did not request for password reset, kindly ignore this mail.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='success'>Successfully. Kindly check your mail for the next procedure.</div>";
$error = 0;
}else if($blocked == 1){
echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a></div>";
}

}else{
echo "<div class='not-success'>This email is not registered.</div>";
}

}

////////////////////////////////////////////////////
if(!empty($a) && !empty($b)){
$result = $db->select($users_tb, "Where id = '{$a}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$enc_email = sha1($row["email"]);
$active = $row["active"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.</div>";
}else if($enc_email == $b && $active == 0){
$fid = $db->query("UPDATE $users_tb SET active = '1' WHERE id = '{$a}'");
if($fid){
echo "<div class='success'>Congrat {$name}! Your account is now activated. Kindly log in.</div>";
}
}else if($enc_email == $b && $active == 1){
echo "<div class='not-success'>Hi {$name}! Your account was previously activated. Kindly log in.</div>";
}else if($enc_email != $b){
echo "<div class='not-success'>Invalid request.</div>";
}

}else{
echo "<div class='not-success'>Invalid request.</div>";
}

}

///////////////////////////////New Password////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($update) && !empty($a2) && !empty($b2) && !empty($password) && !empty($conf_pass) && strlen($password) >= 5 && $password == $conf_pass ){

$new_password = sha1($password);
$user_email = in_table("email",$users_tb,"WHERE id='{$a2}'","email");

$result = $db->select($users_tb, "Where id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.</div>";
}else if($password2 == $b2){

$data_array = array(
"password" => $new_password
);
$act = $db->update($data_array, $users_tb, "id = '{$a2}'");

if($act){
$activity = "Reset own password.";
activity_log($a2, $name, $user_email, $activity);

$_SESSION["msg"] = "<div class='success'>Password successfully updated. Kindly log in with your new password.</div>";
redirect("{$directory}back/");
}else{
echo "<div class='not-success'>Error occured.</div>";
}

}else if($password2 != $b2){
echo "<div class='not-success'>Invalid request.</div>";
}

}else{
echo "<div class='not-success'>Invalid request.</div>";
}

}


///////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($update) && (empty($password2) or empty($conf_pass))){
$_SESSION["notSuccess"] = "<div class='not-success'>Not submitted! All the fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($update) && !empty($password2) && strlen($password2) < 5){
$_SESSION["notSuccess"] = "<div class='not-success'>Not submitted! Password must be atleast 5 characters.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($update) && !empty($password2) && $password2 != $conf_pass){
$_SESSION["notSuccess"] = "<div class='not-success'>Not submitted! Passwords do not match.</div>";
}
/////////////////////////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($login) && (empty($email) or empty($password2))){
echo "<div class='not-success'>All the feilds are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($login) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='not-success'>Not submitted! Invalid  email format.</div>";
}
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($reset) && empty($email)){
echo "<div class='not-success'>Email is required.</div>";
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
 
if(empty($a2) && empty($b2)){
if(!empty($wait)){
echo "<div class=\"alert alert-success alert-dismissable fade in\">Please wait...</div>";	
}else{
?>
<form action="back/" class="login-form" method="post" enctype="multipart/form-data">  
<div class="special-title">Login</div>    
<input type="hidden" name="login" value="1">

<div>
<label for="email">Email</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Username" required value="<?php check_inputted("email"); ?>" style="height:auto;">
</div>
</div>

<div>
<label for="password">Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password" required value="<?php check_inputted("password"); ?>" style="height:auto;">
</div>
</div>
                  
<div>
<a class="toggle-forms form-link" onclick="javascript:$('.login-form').slideToggle();$('.forgot-form').slideToggle();">Forgot Password?</a>
<button class="gen-btn float-right" style="padding:6px 12px; height:auto;"><i class="fa fa-sign-in"></i> Login</button>
</div>

<a href="register/" class="form-link" style="color:#900;">If not registered, kindly click here.</a>

</form>

<form action="back/" class="forgot-form" style="display:none;" method="post" enctype="multipart/form-data">  
<div class="special-title">Change Your Password</div>    
<input type="hidden" name="reset" value="1">

<div>
<label for="email">Email</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your Username" required value="<?php check_inputted("email"); ?>">
</div>
</div>
                     
<div>
<a class="toggle-forms form-link" onclick="javascript:$('.forgot-form').slideToggle();$('.login-form').slideToggle();">Login</a>
<button class="gen-btn float-right"><i class="fa fa-lock"></i> Reset Password</button>
</div>
</form>

<?php  
}
}

if(!empty($a2) && !empty($b2)){

$result = $db->select($users_tb, "Where id = '{$a2}'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$password2 = $row["password"];
$blocked = $row["blocked"];
$name = $row["name"];

if($blocked == 1){
echo "<div class='not-success'>Hi {$name}! Your account is declined. Kindly contact the admin <a href='contact/'>HERE</a>.</div>";
}else if($password2 == $b2){
?>
 
<form action="back/" class="reset-form general-form" id="form-div" method="post" enctype="multipart/form-data">  
<div class="special-title">Hi <?php echo $name; ?>, Your New Password</div>    

<input type="hidden" name="a2" id="a2" required value="<?php echo $a2; ?>">
<input type="hidden" name="b2" id="b2" required value="<?php echo $b2; ?>">
<input type="hidden" name="update" value="1">

<div>
<label for="password">New Password <i>(atleast 5 characters)</i></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your password for login" required value="<?php check_inputted("password"); ?>">
</div>
</div>

<div>
<label for="conf_pass">Retype Password</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Retype your password" required value="<?php check_inputted("conf_pass"); ?>">
</div>
</div> 
                     
<div>
<button class="gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</form>

<?php  
}else if($password2 != $b2){
echo "<div class='not-success'>Invalid request.</div>";
}

}else{
echo "<div class='not-success'>Invalid request.</div>";
}

}
?>

</div>
</div>
</div>

<?php require_once("includes/footer.php"); ?>