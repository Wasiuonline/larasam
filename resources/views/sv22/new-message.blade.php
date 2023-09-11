<?php require_once("../includes/admin-header.php"); 

error_reporting(E_ALL); ini_set('display_errors', 1);
ini_set('memory_limit', '5120M');

role_redirect("send_emails");

$add = nr_input("add");

$users_emails = tp_input("users_emails");
$subject = tp_input("subject");
$subject = decode_content($subject);
$body = tp_input("body");
$body = decode_content($body);

////////Save Football Forum Posts//////////////////////  
if($_SERVER["REQUEST_METHOD"] == "POST" && check_privilege("send_emails") == 1 && !empty($add) && !empty($subject) && !empty($body)){

$users_to_mail = array();

if(!empty($users_emails)){
$new_users_emails = $users_emails . ",";
$new_users_emails = explode(",", $new_users_emails);
foreach($new_users_emails as $value){
$value = trim($value);
if(!empty($value)  && filter_var($value, FILTER_VALIDATE_EMAIL)){
$users_to_mail[] = $value;
}
}
}


if(!empty($_FILES["mail_file"]["tmp_name"])){ 
$file_name = $_FILES["mail_file"]["name"]; 
$file_temp_name = $_FILES["mail_file"]["tmp_name"];
$info   = getimagesize($file_temp_name);
$file_size = $_FILES["mail_file"]["size"];
$file_error_message = $_FILES["mail_file"]["error"];
$file_name_2_array = explode(".", $file_name);
$file_extension = end($file_name_2_array);
$new_file_name = "{$id}-{$ticket_id}-{$rand_no}.csv";
if (($file_extension == "csv" || $file_extension == "CSV") && empty($file_error_message)) {
$move_file = move_uploaded_file($file_temp_name, $new_file_name);
if(file_exists($new_file_name)){
	
$file = fopen($new_file_name,"r");
while(!feof($file))
{
$row = fgetcsv($file);
$email = trim($row[0]);
if(!empty($email)  && filter_var($email, FILTER_VALIDATE_EMAIL)){
$users_to_mail[] = $email;
}
}
fclose($file);

unlink($new_file_name);
}
}
}

	
if(!empty($users_to_mail)){

$users_to_mail = array_unique($users_to_mail);

foreach($users_to_mail as $value){
$to = $value;
$message = $body;
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();
}

$activity = "Sent mail to users, titled: <b>{$subject}</b>.";
activity_log($id, $username, $user_email, $activity);

$_SESSION["msg"] = "<div class='success'>Mail successfully sent.</div>";
redirect("{$directory}{$admin}manage-general-mail/");
}else{
echo "<div class=\"not-success\">Atleast, one valid e-mail is required.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && (empty($subject) || empty($body)) ){
echo "<div class='not-success'>Not submitted! All * fields are required.</div>";
}

if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"]) && empty($subject)){
echo $_SESSION["msg"];
unset($_SESSION["msg"]);
}
?>

<form action="<?php echo $admin; ?>manage-general-mail/" method="post" id="form-div" runat="server" autocomplete="off" enctype="multipart/form-data">

<div class="body-header">Send New Mail</div>    
<input type="hidden" name="add" value="1">

<div class="required">All * fields are required.</div>

<div class="form-group">
<label for="mail_file" class="col-sm-2 control-label">CSV File<span class="required">(Optional)</span></label>
<div class="col-sm-10">
<input type="file" name="mail_file" id="mail_file" class="form-control">
</div>
</div>

<div class="form-group">
<label for="users_emails" class="col-sm-2 control-label">Users Emails<span class="required">(Optional)</span></label>
<div class="col-sm-10">
<textarea rows="3" name="users_emails" id="users_emails" class="form-control" placeholder="Enter emails separated by comma."><?php check_inputted("users_emails"); ?></textarea>
</div>
</div>

<div class="form-group">
<label for="subject" class="col-sm-2 control-label">Subject<span class="required">*</span></label>
<div class="col-sm-10">
<input type="text" name="subject" id="subject" class="form-control" placeholder="Enter the mail subject" value="<?php check_inputted("subject"); ?>" required>
</div>
</div>

<div class="form-group">
<label for="body" class="col-sm-2 control-label">Body<span class="required">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="body" id="body" rows="2" required><?php check_inputted("body"); ?></textarea>
</div>
</div>


<div style="padding-right:15px;">
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-send"></i> Send</button>
</div>
</form>

<script src="js/text_plugin/ckeditor.js"></script>
<script>
<!--
CKEDITOR.replace("body", {
height: 300,
filebrowserBrowseUrl: "/samvick/<?php echo $admin; ?>mail-upload?type=2",
filebrowserUploadUrl: "/samvick/<?php echo $admin; ?>mail-upload?type=1",
disallowedContent : "img{width, height}[width, height]"
});

$(document).ready(function(){

$("#form-div").submit(function(){
$("#body").val(CKEDITOR.instances.body.getData());
});

});
//-->
</script>

<script src="<?php echo new_version("js/general-form.js"); ?>"></script>

</div>
</div>

</div>
<?php require_once("../includes/portal-footer.php"); ?>