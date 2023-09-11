@extends('layouts.app')

@section('content')

<div class="home-body-wrapper"> 
<div class="container">

<?php
$table = "`project_photos`";
$title_slug = tr_input("title_slug");
$view = in_table("id",$table,"WHERE title_slug = '{$title_slug}'","id");
$pn = nr_input("pn");

//=======================View Event Details==============================//
if(!empty($view)){
$result = $db->select($table, "WHERE id='$view'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$item_id = $row["id"];
$project_date = sub_date($row["project_date"]);
$title = decode_content($row["title"]);
$location = decode_content($row["location"]);
$details = decode_content($row["details"]);
$date_posted = full_date($row["date_posted"]);
$posted_by = $row["posted_by"];
$poster_name = in_table("name",$users_tb,"WHERE id = '{$posted_by}'","name");
$poster_email = in_table("email",$users_tb,"WHERE id = '{$posted_by}'","email");

$slide_array1 = glob("images/items-featured/{$item_id}_{$posted_by}_item_featured_*.*");
$slide_array2 = glob("images/items-displayed/{$item_id}_{$posted_by}_item_displayed_*.*");
$file_name = det_image("items-featured/{$item_id}_{$posted_by}_item_featured_*.*", 0);
?>

<style>
<!--
.description-title{
color:#f11;
}
.fotorama__caption__wrap{
color:#000;
}
.single-fotorama-description{
color:#000;
padding:5px;
}

.item-title2{
font-size:25px;
font-weight:900;
margin-top:5px;
margin-bottom:5px;
text-align:left;
}
.remove-overflow{
padding: 0px;
}
.item-analysis{
padding:10px;
}
.phone-no{
color:#f11; 
font-weight:900;
display:none;
}
.btn-success1{
padding:10px;
margin-top:10px;
}
.btn-success1 *{
color:#fff;
}
.poster-name{
font-weight:900; 
color:#000;
}
.share-buttons{
border:1px solid #ddd;
padding:10px;
margin-top:10px;
}
.share-buttons h3{
margin-top:0px;
}
.share-buttons .btn{
margin-bottom:2px;
}
.share-buttons .btn *{
color:#fff;
}
@media(max-width:400px){
.share-buttons .btn{
width:100%;
}
}
-->
</style>

<div class="home-body-wrapper"> 
<div class="container" style="overflow:visible;"> 

<div><a class="btn gen-btn float-left" style="padding:5px; margin-left:5px; margin-right:20px;" onclick="javascript: history.go(-1);"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>

<div class="item-title2"><?php echo $title; ?></div>

<div>

<link rel="stylesheet" href="css/fotorama.css">
<script src="js/fotorama.js"></script>

<div class="col-md-7 remove-overflow">

<?php if(count($slide_array2) > 1){ ?>
<div class="fotorama" data-width="600" data-ratio="2.5/2" data-nav="thumbs" data-thumbheight="48">
<?php $c = 0;
foreach($slide_array2 as $val){
if(file_exists($val)){
$file_session_no_arr = explode("_",$val);
$file_session_no = $file_session_no_arr[4];
$picture_description = in_table("picture_description","sub_project_photos","WHERE project_id = '$item_id' AND file_session_no = '$file_session_no'","picture_description");
?>
<a href="<?php echo $val; ?>" data-caption="<?php echo $picture_description; ?>"><img src="<?php echo (file_exists($slide_array1[$c]))?$slide_array1[$c]:""; ?>"></a>
<?php
}
$c++;
}
?>
</div> 
<?php }else{ 
$val = $slide_array2[0];
if($val){
$file_session_no_arr = explode("_",$val);
$file_session_no = $file_session_no_arr[4];
$picture_description = in_table("picture_description","sub_project_photos","WHERE project_id = '$item_id' AND file_session_no = '$file_session_no'","picture_description");
?>
<div><img src="<?php echo $val; ?>"></div>
<div class="single-fotorama-description"><?php echo $picture_description; ?></div>
<?php 
}
}

if(!empty($details)){ ?>
<h3 class="description-title">Details</h3>
<?php echo $details;
} 
?>

</div>
<div class="col-md-5">

<h3 class="description-title">Event Date</h3>
<p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $project_date; ?></p>

<h3 class="description-title">Location</h3>
<p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $location; ?></p>

<hr style="border:#dde 1px solid" />

<div class="share-buttons border-radius">
<h3 class="description-title">Share ad on:</h3>
<a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode($actual_link); ?>" class="btn btn-primary" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($actual_link); ?>&text=<?php echo urlencode($page_title); ?>" class="btn btn-success" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
<a href="https://plus.google.com/share?url=<?php echo $actual_link; ?>" class="btn btn-danger" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a>
<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($actual_link); ?>&title=<?php echo urlencode($page_title); ?>&summary=<?php echo urlencode(strip_tags($details)); ?>&source=" class="btn  btn-primary" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a>
<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($actual_link); ?>&media=<?php echo urlencode($directory . $slide_array1[0]); ?>&description=<?php echo urlencode($page_title); ?>" class="btn btn-danger" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</a>
<a href="https://api.whatsapp.com/send?text=<?php echo urlencode($actual_link); ?>" class="btn btn-success" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
</div>


</div>
</div>

<?php
$result = $db->select($table, "WHERE NOT(id = '$item_id')", "*", "ORDER BY id DESC", "LIMIT 4");
if(count_rows($result) > 0){
?>
<h1 class="home-adverts-tag">Related Projects</h1>
<div class="item-wrapper">
<?php
while($row = fetch_data($result)){
load_project_photo();
}
?>
</div>
<?php
}
?>

</div>
</div>

<?php 
}else{
?>
<div style="padding-left:10px;"><a onclick="javascript: history.back(1);" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back</a></div>
<div class="not-success">This project does not exist.</div>
<?php
} 
}else{
?>
<div style="padding-left:10px;"><a onclick="javascript: history.back(1);" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back</a></div>
<div class="not-success">Invalid Access.</div>
<?php
} 
?>

</div>
</div>

@endsection