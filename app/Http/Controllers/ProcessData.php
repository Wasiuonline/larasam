<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubProjectPhoto;
use App\Models\ItemsSize; 
use App\Http\Controllers\GenClass; 
use Illuminate\Support\Facades\File;
use File as FileMC;
use Image;
use DB;

class ProcessData extends Controller
{
	
/*
header("Access-Control-Allow-Origin: https://www.reliancewisdom.com");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once("../classes/db-class.php");
require_once("../includes/functions.php");
require_once("../includes/resize-image.php");

$state = np_input("state");

$email = tp_input("email");
$newsletter = tp_input("newsletter");

$parameter = tp_input("parameter");
$parameter_value = tp_input("parameter_value");

$my_item_img = tp_input("my_item_img");
$edit_my_item_img = tp_input("edit_my_item_img");
$edit_my_item_img2 = tp_input("edit_my_item_img2");
$session_item_img = tp_input("session_item_img");
$edit_id = np_input("edit_id");

$picture_description = tp_input("picture_description");

$item_user_id = tp_input("item_user_id");
$item_id = tp_input("item_id"); 

$save_item = np_input("save_item"); 
$separator = np_input("separator"); 

///////////////Newsletter///////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($newsletter) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

$result = $db->select("newsletter", "Where email = '{$email}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"email" => $email
);

$act = $db->insert($data_array, "newsletter");

if($act){

$to = $email;
$subject = "Newsletter Subscription";
$message = "<p>Thank you for signing up for subscribing for our newsletters.</p>
<p>We will keep you updated as soon as possible.</p>";
$message = message_template();
$headers = "{$gen_name} <no-reply@{$domain}>";
send_mail();

echo "<div class='success'>Newsletter subscription was successful.</div>";
}else{
echo "<div class='not-success'>Error occured.</div>";
}
}else{
echo "<div class='not-success'>Not Successful. Email already exists.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($newsletter) && empty($email)){
echo "<div class='not-success'>Not Successful. All fields are required.</div>";
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($newsletter) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<div class='not-success'>Not Successful. Invalid email format.</div>";
}
///////////////////////////////////////////
*/

////////////// Upload project image //////////////////////////////
public static function upload_project_image(Request $request){
if($request->hasFile('item_img') && !empty($request->my_item_img) && !empty($request->picture_description)){ 

$ticket_id = GenClass::gen("ticket_id");
$rand_no = GenClass::gen("rand_no");
if($request->session()->missing('item_img')){
$data = public_path("images/items-temp/" . auth()->user()->id . "_item_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}	
}

$upload = GenClass::upload_item_image($request, "item_img", auth()->user()->id . "_item_displayed_", "items-temp", "650*500", "350*350", "", "item_img");

if($upload[0] == 1){
?>
<div id="result2-<?php echo $ticket_id; ?>" class="event-wrapper">
<div class="col-sm-4 col-xs-6" style="padding:0px;">
<form action="process-data/edit-project-image" id="result-<?php echo $ticket_id; ?>" class="general-form2-<?php echo $ticket_id . $rand_no; ?> edit-form-<?php echo $ticket_id; ?>" name="my-item-default-<?php echo $ticket_id; ?>"  lang="my-item-loading-<?php echo $ticket_id; ?>" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
<input type="hidden" name="edit_my_item_img" value="1" />
<input type="hidden" name="session_item_img" value="<?php echo $ticket_id; ?>" />
<div class="new-item-pic">
<div class="item-pic-img"> 
<div class="relative-div">
<div class="item-pic-option"> 
<label for="edit_item_img_<?php echo $ticket_id; ?>" class="fileupload-new float-left" title="Change picture">
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-item-loading-<?php echo $ticket_id; ?>"></i>
<i class="fa fa-refresh" aria-hidden="true" id="my-item-default-<?php echo $ticket_id; ?>"></i>                          
</label>
<button type="button" title="Delete picture" class="delete-item-picture" onclick="javascript: delete_file('process-data/delete-project-image', 'del_item_file', '<?php echo $ticket_id; ?>', 'delete-<?php echo $ticket_id; ?>', 'result2-<?php echo $ticket_id; ?>');"><i class="fa fa-trash" aria-hidden="true"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-<?php echo $ticket_id; ?>" aria-hidden="true"></i></button>
</div>
<div class="item-image-wrapper result-<?php echo $ticket_id; ?>">
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn-file upload-padding">
<input type="file" name="edit_item_img" id="edit_item_img_<?php echo $ticket_id; ?>" onchange="javascript: $('.edit-form-<?php echo $ticket_id; ?>').submit();">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
</div>
</form>

<script>
<!--
$("body").find( ".general-form2-<?php echo $ticket_id . $rand_no; ?>" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");
var this_name = $(this).attr("name");
var this_lang = $(this).attr("lang");

document.getElementById(this_name).style.display = "none";
document.getElementById(this_lang).style.display = "inline-block";
$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "inline-block";

$("." + page_result).html(data);

},error: function(){
sweetAlert("Notice", "Error occured!", "error");
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "inline-block";
}
});

});
//-->
</script>
</div>
<div class="col-sm-8 col-xs-6 picture-description"><?php echo $request->picture_description; ?></div>
</div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////


////////////// Edit Project Image //////////////////////////////
public static function edit_project_image(Request $request){
if($request->hasFile('edit_item_img') && !empty($request->edit_my_item_img)){ 

$ticket_id = GenClass::gen("ticket_id");
$rand_no = GenClass::gen("rand_no");

$data = public_path("images/items-temp/" . auth()->user()->id . "_item_*_" . $request->session_item_img . "_*.*");
$file_array = File::glob($data);

$upload = GenClass::upload_item_image($request, "edit_item_img", auth()->user()->id . "_item_displayed_", "items-temp", "650*500", "350*350", $request->session_item_img, "item_img");

if($upload[0] == 1){
if(session('item_img')[$request->session_item_img] != null){
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}	
}
?>
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////

// Delete Project File
public static function delete_project_image(Request $request){
if(!empty($request->parameter) && !empty($request->parameter_value) && $request->parameter == "del_item_file"){

$data = public_path("images/items-temp/" . auth()->user()->id . "_item_*_" . $request->parameter_value . "_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

$request->session()->forget(['item_img.' . $request->parameter_value, 'item_img_description.' . $request->parameter_value]);

echo 1;
}
}
///*/////////////////////////////


////////////// Update Change project pictures //////////////////////////////
public static function change_project_image(Request $request){
if($request->hasFile('edit_item_img') && !empty($request->edit_my_item_img2) && !empty($request->item_user_id) && !empty($request->item_id)){ 

$item_user_id = $request->item_user_id;
$item_id = $request->item_id;
$session_item_img = $request->session_item_img;

$data = public_path("images/items-featured/{$item_id}_{$item_user_id}_item_featured_{$session_item_img}_*.*");
$file_array1 = File::glob($data);
$data = public_path("images/items-displayed/{$item_id}_{$item_user_id}_item_displayed_{$session_item_img}_*.*");
$file_array2 = File::glob($data);
$file_array = array_merge($file_array1,$file_array2);	

$upload = GenClass::upload_item_image($request, "edit_item_img", "{$item_id}_{$item_user_id}_item_displayed_", "items-displayed", "650*500", "350*350", $session_item_img);

if($upload[0] == 1){
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}
?>
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////

////////////// Update Change Project Description //////////////////////////////
public static function change_project_description(Request $request){
if(!empty($request->picture_description_update_id) && !empty($request->picture_description_update)){ 

	$formFields = [
	'picture_description' => $request->picture_description_update,
	'date_updated' => GenClass::gen("date_time"),
	'updated_by' => auth()->user()->id
	];	
	SubProjectPhoto::where('id', $request->picture_description_update_id)->update($formFields);

	echo $request->picture_description_update;
}
}

////////////// Delete Changed Project Pictures //////////////////////////////
public static function delete_changed_project_image(Request $request){ 
if(!empty($request->parameter) && !empty($request->parameter_value) && $request->parameter == "del_item_file2"){

$file_name_array = explode("_",$request->parameter_value);
$item_id = $file_name_array[0];
$item_user_id = $file_name_array[1];
$item_session_no = $file_name_array[4];

$data = public_path("images/items-featured/{$item_id}_{$item_user_id}_item_featured_{$item_session_no}_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

$data = public_path("images/items-displayed/{$item_id}_{$item_user_id}_item_displayed_{$item_session_no}_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

SubProjectPhoto::where('project_id', $item_id)->where('file_session_no', $item_session_no)->delete();
echo 1;

}
}
///////////////////////////////

/*
/////============Save Item===============/////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($save_item) && $separator == 1){

$result = $db->select("saved_items", "WHERE user_id='$id' AND item_id='$save_item'", "*", "");

if(count_rows($result) == 0){
$user_data_array = array(
"user_id" => $id,
"item_id" => $save_item,
"date_time" => $date_time
);
$db->insert($user_data_array, "saved_items");
echo "1";
}else if(count_rows($result) == 1){
$db->delete("saved_items","user_id='$id' AND item_id='$save_item'");
echo "2";
}

}

/////============Save Blog Post===============/////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($save_item) && $separator == 2){

$result = $db->select("saved_blog_posts", "WHERE user_id='$id' AND post_id='$save_item'", "*", "");

if(count_rows($result) == 0){
$user_data_array = array(
"user_id" => $id,
"post_id" => $save_item,
"date_time" => $date_time
);
$db->insert($user_data_array, "saved_blog_posts");
echo "1";
}else if(count_rows($result) == 1){
$db->delete("saved_blog_posts","user_id='$id' AND post_id='$save_item'");
echo "2";
}

}

//////====== Load Local Governments ====/////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($state)){
$result = $db->select("local_governments", "WHERE state = '{$state}'", "*", "ORDER BY local_government ASC");
if(count_rows($result) > 0){
echo "<option value=\"\">**Select a local government**</option>";
while($row = fetch_data($result)){
$local_government_id = $row["id"];
$local_government = $row["local_government"];
echo "<option value=\"{$local_government_id}\">{$local_government}</option>";
}
}
}
*/
///////////////////////////////




////////////// Upload product image //////////////////////////////
public static function upload_product_image(Request $request){
if($request->hasFile('product_img') && !empty($request->my_product_img)){ 

$ticket_id = GenClass::gen("ticket_id");
$rand_no = GenClass::gen("rand_no");
if($request->session()->missing('product_img')){
$data = public_path("images/products-temp/" . auth()->user()->id . "_product_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}	
}

$upload = GenClass::upload_item_image($request, "product_img", auth()->user()->id . "_product_displayed_", "products-temp", "650*500", "350*350", "", "product_img", "product");

if($upload[0] == 1){
?>
<div id="result2-<?php echo $ticket_id; ?>" class="event-wrapper col-sm-4 col-xs-6" style="padding:0px;">
<form action="process-data/edit-product-image" id="result-<?php echo $ticket_id; ?>" class="general-form2-<?php echo $ticket_id . $rand_no; ?> edit-form-<?php echo $ticket_id; ?>" name="my-item-default-<?php echo $ticket_id; ?>"  lang="my-item-loading-<?php echo $ticket_id; ?>" title="Item picture" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
<input type="hidden" name="edit_my_product_img" value="1" />
<input type="hidden" name="session_product_img" value="<?php echo $ticket_id; ?>" />
<div class="new-item-pic">
<div class="item-pic-img"> 
<div class="relative-div">
<div class="item-pic-option"> 
<label for="edit_product_img_<?php echo $ticket_id; ?>" class="fileupload-new float-left" title="Change picture">
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-item-loading-<?php echo $ticket_id; ?>"></i>
<i class="fa fa-refresh" aria-hidden="true" id="my-item-default-<?php echo $ticket_id; ?>"></i>                          
</label>
<button type="button" title="Delete picture" class="delete-item-picture" onclick="javascript: delete_file('process-data/delete-product-image', 'del_product_file', '<?php echo $ticket_id; ?>', 'delete-<?php echo $ticket_id; ?>', 'result2-<?php echo $ticket_id; ?>');"><i class="fa fa-trash" aria-hidden="true"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-<?php echo $ticket_id; ?>" aria-hidden="true"></i></button>
</div>
<div class="item-image-wrapper result-<?php echo $ticket_id; ?>">
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn-file upload-padding">
<input type="file" name="edit_product_img" id="edit_product_img_<?php echo $ticket_id; ?>" onchange="javascript: $('.edit-form-<?php echo $ticket_id; ?>').submit();">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
</div>
</form>

<script>
<!--
$("body").find( ".general-form2-<?php echo $ticket_id . $rand_no; ?>" ).on( "submit", function(e) {
e.preventDefault();  
var formdata = new FormData(this);
var page_url = $(this).attr("action");
var page_result = $(this).attr("id");
var this_name = $(this).attr("name");
var this_lang = $(this).attr("lang");

document.getElementById(this_name).style.display = "none";
document.getElementById(this_lang).style.display = "inline-block";
$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "inline-block";

$("." + page_result).html(data);

},error: function(){
sweetAlert("Notice", "Error occured!", "error");
document.getElementById(this_lang).style.display = "none";
document.getElementById(this_name).style.display = "inline-block";
}
});

});
//-->
</script>
</div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////


////////////// Edit Product Image //////////////////////////////
public static function edit_product_image(Request $request){
if($request->hasFile('edit_product_img') && !empty($request->edit_my_product_img)){ 

$ticket_id = GenClass::gen("ticket_id");
$rand_no = GenClass::gen("rand_no");

$data = public_path("images/products-temp/" . auth()->user()->id . "_product_*_" . $request->session_product_img . "_*.*");
$file_array = File::glob($data);

$upload = GenClass::upload_item_image($request, "edit_product_img", auth()->user()->id . "_product_displayed_", "products-temp", "650*500", "350*350", $request->session_product_img, "product_img", "product");

if($upload[0] == 1){
if(session('product_img')[$request->session_product_img] != null){
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}	
}
?>
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////

// Delete Item File
public static function delete_product_image(Request $request){
if(!empty($request->parameter) && !empty($request->parameter_value) && $request->parameter == "del_product_file"){

$data = public_path("images/products-temp/" . auth()->user()->id . "_product_*_" . $request->parameter_value . "_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

$request->session()->forget(['product_img.' . $request->parameter_value]);

echo 1;
}
}
///*/////////////////////////////

///====Delete Item Size====////
public static function delete_product_size(Request $request){
	ItemsSize::where('id', $request->item_size)->delete();
	echo 1;
}

////////////// Update Change items pictures //////////////////////////////
public static function change_product_image(Request $request){
if($request->hasFile('edit_product_img') && !empty($request->edit_my_product_img2) && !empty($request->item_user_id) && !empty($request->item_id)){ 

$item_user_id = $request->item_user_id;
$item_id = $request->item_id;
$session_product_img = $request->session_product_img;

$data = public_path("images/products-featured/{$item_id}_{$item_user_id}_product_featured_{$session_product_img}_*.*");
$file_array1 = File::glob($data);
$data = public_path("images/products-displayed/{$item_id}_{$item_user_id}_product_displayed_{$session_product_img}_*.*");
$file_array2 = File::glob($data);
$file_array = array_merge($file_array1,$file_array2);	

$upload = GenClass::upload_item_image($request, "edit_product_img", "{$item_id}_{$item_user_id}_product_displayed_", "products-displayed", "650*500", "350*350", $session_product_img, "", "product");

if($upload[0] == 1){
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}
?>
<div class="item-image-bg" style="background:url(<?php echo asset($upload[1]); ?>) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
<?php
}else if($upload[0] == false){
echo $upload[1];
}

}
}
//////////////////////////////////////////

////////////// Delete Changed Project Pictures //////////////////////////////
public static function delete_changed_product_image(Request $request){ 
if(!empty($request->parameter) && !empty($request->parameter_value) && $request->parameter == "del_product_file2"){

$file_name_array = explode("_",$request->parameter_value);
$item_id = $file_name_array[0];
$item_user_id = $file_name_array[1];
$item_session_no = $file_name_array[4];

$data = public_path("images/products-featured/{$item_id}_{$item_user_id}_product_featured_{$item_session_no}_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

$data = public_path("images/products-displayed/{$item_id}_{$item_user_id}_product_displayed_{$item_session_no}_*.*");
$file_array = File::glob($data);
foreach ($file_array as $filename) {
if(file_exists($filename)){
FileMC::delete($filename);
}
}

ItemsSize::where('project_id', $item_id)->where('file_session_no', $item_session_no)->delete();
echo 1;

}
}
///////////////////////////////




}
?>