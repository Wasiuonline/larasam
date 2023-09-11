@extends('layouts.app')

@section('content')
<style>
<!--
.special-title{
padding:20px;
font-size:25px;
background:#eee;
color:#000;
margin-bottom:10px;
margin-top:10px;
}
.special-title *{
color:#000;
}
.form-group i{
color:#000;
}
.special{
background:#f55;
color:#fff;
font-size:#18px;
margin-bottom:10px;
text-align:center;
}
.special i{
color:#fff;
}
.special:hover{
color:#fff;
background:#f33;
}
.content-vission input[type="text"], .content-vission input[type="email"], .content-vission textarea{
color:#333 !important;
}
.check-spam{
color:#f11!important;
font-weight:900!important;
}
-->
</style>

<?php
/*$name = tp_input("name");
$email = tp_input("email");
$phone = np_input("phone");
$subject = tp_input("subject");
$subject2 = $subject;
$message = tp_input("message");
$message2 = $message;
$check_user = tp_input("check_user");

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($phone) && strlen($phone) >= 5 && !empty($subject) && !empty($message) && $check_user == $_SESSION["spam_checker"]){

$to = $email;
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject2}";
$message = "<p>Thank you for using our customer support service.</p>
<p>We will get back to you as soon as possible.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";

$act1 = send_mail();

$to = $gen_email;
$subject = "Ticket #{$ticket_id}: Inquiry on {$subject2}";
$message = "<p><b>Email:</b> {$email}</p><p><b>Phone Number:</b> {$phone}</p><p>{$message2}</p>";
$foot_note = $regards = "";
$message = message_template();
$headers = "{$name} <{$email}>";
$act2 = send_mail(1);

$error = 0;

$admin_data_array = array(
"ticket_id" => $ticket_id,
"sender_name" => $name,
"sender_email" => $email,
"sender_phone" => $phone,
"recipient_name" => $gen_name,
"recipient_email" => $gen_email,
"subject" => $subject2,
"message" => $message2,
"inbox" => 1,
"date_time" => $date_time
);
$db->insert($admin_data_array, "admin_messages");

$admin_ticket_id = $ticket_id . in_table("id","admin_messages","WHERE sender_email = '{$email}' AND date_time = '{$date_time}'","id");
$db->query("UPDATE admin_messages SET ticket_id = '{$admin_ticket_id}', date_time = '{$date_time}' WHERE sender_email = '{$email}' AND date_time = '{$date_time}'");

$_SESSION["msg"] = "<div class='success'>Your message was successfully sent. We will get back to you shortly.</div>";
redirect("{$directory}contact/");
}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message) || empty($check_user))){
echo "<div class='not-success'>Not Successful. All fields must be properly filled.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='not-success'>Not Successful. Invalid email format.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($phone) && strlen($phone) < 5){
echo "<div class='not-success'>Not Successful. Phone number must not be less than 5 digits.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($check_user) && $check_user != $_SESSION["spam_checker"]){
echo "<div class='not-success'>Not submitted! Incorrect check code.</div>";
}

if(isset($_SESSION["msg"]) && !isset($_POST["mail"])){
echo $_SESSION["msg"];
unset($_SESSION["msg"]);
}*/
?>

<div class="home-body-wrapper"> 
<div class="container"> 

<div class="col-md-5 content-body">

<p>&nbsp;</p>

<div class="body-header"><i class="fa fa-building" aria-hidden="true"></i> Contact Office</div>
<p class="align-center">30, Abata Street, Orile Iganmu, Lagos.</p>

<div class="body-header"><i class="fa fa-envelope" aria-hidden="true"></i> Email</div>
<p class="align-center"><a href="mailto:<?php //echo $gen_email; ?>"><?php //echo $gen_email; ?></a></p>

<div class="body-header"><i class="fa fa-phone" aria-hidden="true"></i> Phone</div>
<p class="align-center"><b>Line 1:</b> <a href="tel:+2348033197040"><?php //echo $gen_phone; ?></a></p>
<p class="align-center"><b>Line 2:</b> <a href="tel:+2348029496864">+234 (0)802 949 6864</a></p>
<p class="align-center"><b>Line 3:</b> <a href="tel:+2348130700865">+234 (0)813 070 0865</a></p>

</div>
<div class="col-md-7 content-vission">
<form action="contact/" method="post" class="special-form" id="contact-result" runat="server" name="send_mail" autocomplete="off" enctype="multipart/form-data">  

<div class="special-title border-radius"><i class="fa fa-envelope"></i> Send us a mail</div>

<input type="hidden" name="mail" value="1">

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="name" id="name" class="form-control" placeholder="Your Full Name" required value="<?php //echo (isset($_SESSION["id"]))?$username:check_inputted("name"); ?>">
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
<input type="email" name="email" id="email" class="form-control" placeholder="Your E-mail Address" required value="<?php //echo (isset($_SESSION["id"]))?$user_email:check_inputted("email"); ?>">
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
<input type="text" name="phone" id="phone" class="form-control only-no" placeholder="Your Phone Number" required value="<?php //check_inputted("phone"); ?>">
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject (Make it short)" required value="<?php //check_inputted("subject"); ?>">
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
<textarea type="text" name="message" id="message" class="form-control" placeholder="Details" required value=""><?php //check_inputted("message"); ?></textarea>
</div>

<label for="check_user">Type this check code below: <span class="check-spam"><?php //$_SESSION["spam_checker"] = rand(1000,9999); echo $_SESSION["spam_checker"]; ?></span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="text" name="check_user" id="check_user" class="form-control only-no"  maxlength="4" placeholder="Type the check code here" required value="" style="height:auto;">
</div>

<div class="align-right">
<button class="btn special" name="send"><i class="fa fa-send"></i> Send</button>
</div>

</form>

<script>
<!--
$(document).ready(function () {

$(".only-no").keyup(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
}).change(function(){
var this_val = this.value;
if(isNaN(this_val)){
this.value = this_val.replace(/[^0-9.]/gi, "");
}	
});

});
//-->
</script>

</div>

<div class="col-md-12">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.2988996132653!2d3.3435706140939816!3d6.4837794254242995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8c070e26ff69%3A0xcde2211a5bf3b27a!2s30%20Abata%20St%2C%20Orile%20Iganmu%20101241%2C%20Lagos!5e0!3m2!1sen!2sng!4v1650289981807!5m2!1sen!2sng" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>


</div>
</div>

@endsection