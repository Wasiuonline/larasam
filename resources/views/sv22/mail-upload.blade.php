<?php
include_once("../includes/gen-header.php");
require_once("../includes/resize-image.php");

$type = nr_input("type");
$pn = nr_input("pn");
////////////// Upload image //////////////////////////////
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($id) && $type == 1 && !empty($_FILES["upload"]["tmp_name"])){ 

upload_mail_image("upload", "mail-{$id}-{$ticket_id}-", "../{$images}mail/", "500", "400");

// Required: anonymous function reference number as explained above.
$funcNum = $_GET["CKEditorFuncNum"] ;
// Optional: instance name (might be used to load a specific configuration file or anything else).
$CKEditor = $_GET["CKEditor"] ;
// Optional: might be used to provide localized messages.
$langCode = $_GET["langCode"] ;
// Optional: compare it with the value of `ckCsrfToken` sent in a cookie to protect your server-side uploader against CSRF.
// Available since CKEditor 4.5.6.
$token = $_POST["ckCsrfToken"] ;

// Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
$url = str_replace("..","/samvick",$resized_file);
// Usually you will only assign something here if the file could not be uploaded.
///$message = "";

echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '{$url}', '$message');</script>";
}

if($_SERVER['REQUEST_METHOD'] == "GET" && !empty($id) && $type == 2){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php directory(); ?>" target="_top">
<meta charset="UTF-8" />
<meta name="robots" content="index, follow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="OIPA">
<meta name="author" content="OIPA">
<link rel="alternate" href="<?php directory(); ?>" hreflang="en-ng"/>
<link rel="shortcut icon" href="<?php echo new_version("{$images}favicon.png"); ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo new_version("{$images}favicon.png"); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo new_version("{$images}favicon.png"); ?>">
<title>Select a Picture</title>
  
<!-- Favicons-->
<link rel="icon" href="<?php echo new_version("{$images}favicon.png"); ?>">
<!-- Favicons-->
<link rel="apple-touch-icon-precomposed" href="<?php echo new_version("{$images}favicon.png"); ?>">
<!-- For iPhone -->
<meta name="msapplication-TileColor" content="#b20">
<meta name="msapplication-TileBackground" content="#000">
<meta name="msapplication-TileImage" content="<?php echo new_version("{$images}favicon.png"); ?>">
<!-- For Windows Phone -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">

<script>
<!--
// Helper function to get parameters from the query string.
function getUrlParam( paramName ) {
	var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
	var match = window.location.search.match( reParam );

	return ( match && match.length > 1 ) ? match[1] : null;
}
// Simulate user action of selecting a file to be returned to CKEditor.
function returnFileUrl(url) {

	var funcNum = getUrlParam( 'CKEditorFuncNum' );
	var fileUrl = url;
	window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
	window.close();
}
//-->
</script>
<style>
<!--
html{
overflow-y:scroll;
cursor:default;
}
html,body{
overflow-x:hidden;
width:100%;
}
html,body, img, a{
vertical-align:top;
text-align:left;
border:0px;
padding:0px;
margin:0px;
color:#666;
font-size:14px;
font-weight:normal;
font-family: 'Monda', Verdana, serif, Arial, Helvetica, sans-serif;
transition: all 0.2s ease-in-out;
-webkit-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out; 
box-sizing: border-box;
}
body{
overflow:visible;
height:100%;
background:#fff;
}
div.images-wrapper {
  /* Prevent vertical gaps */
  line-height: 0;
   
  -webkit-column-count: 5;
  -webkit-column-gap:   0px;
  -moz-column-count:    5;
  -moz-column-gap:      0px;
  column-count:         5;
  column-gap:           0px;  
}

div.images-wrapper img {
/* Just in case there are inline attributes */
width: 100% !important;
height: auto !important;
border:5px solid #fff;
}
div.images-wrapper img:hover{
border:5px solid #f66;
}

div.images-wrapper a{
text-decoration:none !important;
overflow:hidden;
float:left;
cursor:pointer;
}

/* =========== Page Numbers ===================== */
div.page-nos{
display:block;
clear:both;
padding:5px;
overflow:hidden;
}
div.page-nos a{
padding:8px;
padding-top:1px;
padding-bottom:1px;
margin:1px;
background:#fff;
color:#f11;
border:1px solid #f66;
text-decoration:none;
float:left;
}
div.page-nos a:hover, div.page-nos a.current{
background:#f66;
color:#fff;
}

.not-success{
text-align:center;
padding:15px;
margin-top:10px;
margin-bottom:10px;
color: #a94442;
background-color: #f2dede;
border-color: #ebccd1;
}
.not-success *{
color: #a94442;
}

@media (max-width: 1200px) {
 div.images-wrapper {
  -moz-column-count:    4;
  -webkit-column-count: 4;
  column-count:         4;
  }
}
@media (max-width: 1000px) {
  div.images-wrapper {
  -moz-column-count:    3;
  -webkit-column-count: 3;
  column-count:         3;
  }
}
@media (max-width: 800px) {
  div.images-wrapper {
  -moz-column-count:    2;
  -webkit-column-count: 2;
  column-count:         2;
  }
}
@media (max-width: 400px) {
  div.images-wrapper {
  -moz-column-count:    1;
  -webkit-column-count: 1;
  column-count:         1;
  }
}
-->
</style>
</head>
<body>
<?php 
$result = glob("../{$images}mail/mail-{$id}-*.*");
$count = count($result);

if($count > 0){
?>
<div>
<div class="images-wrapper">
<?php
$per_view = 24;
$page_link = "{$admin}mail-upload?pn=";
$link_suffix = "&type={$type}";
$style_class = "";
page_numbers();

$gross_view = $per_view * $pn;
$start_point = $count - ($gross_view - $per_view) - 1;
$end_point = $count - $gross_view;

for($i=$start_point; $i>=$end_point; $i--){
if($i >= 0){
$value = str_replace("..", "/samvick", $result[$i]);
echo "<a onclick=\"javascript: returnFileUrl('{$value}');\"><img src=\"{$value}\"></a>";
}
}
?>
</div>
<?php echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":""; ?>
</div>
<?php
}else{
echo "<div class=\"not-success\">You have not uploaded any picture. Kindly select the \"Upload\" tab to upload a picture.</div>";
}
?>
</body>
</html>
<?php
}
?>