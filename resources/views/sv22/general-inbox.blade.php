<?php if(!isset($_REQUEST["gh"])){ include_once("../includes/admin-header.php"); 
}else{ 
include_once("../includes/gen-header.php");
} ?> 

<?php
role_redirect("manage_general_inbox");

$view = nr_input("view");

/////////////////////////////////////////////////////////////////////////////////////////
if(check_privilege("manage_general_inbox") == 1 && isset($_POST["delete"]) && isset($_POST["del"])){
$i = 0;
if(is_array($_POST["del"])){
foreach ($_POST["del"] as $k => $c) {
if($c != ""){ 
$c = testQty($c);
$act = $db->delete("admin_messages", " id='{$c}' AND recipient_email = '$gen_email' AND inbox = '1'");	
$i++;			
}else{
continue;
}
}

if($act){

$activity = "Deleted {$i} inbox message(s).";
activity_log($id, $username, $user_email, $activity);

echo "<div class='success'>{$i} message(s) successfully deleted.</div>";
}else{
echo "<div class='not-success'>Error. Unable to delete message(s).</div>";
}

}else{
echo "<div class='not-success'>Atleast one field must be selected.</div>";
}
}

////////////////////////////////////////////////////******************************//////////////

$result = $db->select("admin_messages", "WHERE recipient_email = '$gen_email' AND inbox = '1'", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "{$admin}general-inbox/pn/";
$link_suffix = "/";
$style_class = "general-link";
page_numbers();
?>

<?php if(empty($view)){ ?>
<div class="page-title">General Inbox (From Contact Us Page)</div>
<?php
$d = 0;

$offset = ($per_view * $pn) - $per_view;

$result = $db->select("admin_messages", "WHERE recipient_email = '$gen_email' AND inbox = '1'", "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");

if(count_rows($result) > 0){
?>
<form action="<?php echo $admin; ?>general-inbox/" class="general-form" id="form-div" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="overflow-x:auto;">
<input type="hidden" name="pn" value="<?php echo $pn; ?>"> 
<input type="hidden" name="gh" value="1"> 
<input type="hidden" name="delete" value="1"> 
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>ID</th>
<th>Subject</th>
<th>Sent by</th>
<th>Date Received</th>
<th>View</th>
<th style="width:30px;"><input type="checkbox" name="sel_all" id="delG" class="sel-group" value=""></th>
</tr>
</thead>
<tbody>
<?php
while($row = fetch_data($result)){
$msg_id = $row["id"];
$subject = $row["subject"];
$sender_name = $row["sender_name"];
$sender_email = $row["sender_email"];
$viewed = $row["viewed"];
$date = min_full_date($row["date_time"]);
?>
<tr<?php echo ($viewed == 0)?" class=\"not-viewed\" title=\"Not viewed\"":" title=\"Viewed\""; ?>>
<td><?php echo $msg_id; ?></td>
<td><?php echo $subject; ?></td>
<td><?php echo "{$sender_name}<br>({$sender_email})"; ?></td>
<td><?php echo $date; ?></td>
<td><a href="<?php echo $admin; ?>general-inbox/view/<?php echo $msg_id; ?>/pn/<?php echo $pn; ?>/" class="btn gen-btn general-link" title="View message #<?php echo $msg_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
<td><input type="checkbox" name="del[<?php echo $d; ?>]" id="del<?php echo $d; ?>" class="delG" value="<?php echo $msg_id; ?>"></td>
</tr>
<?php 
$d++;
}
?>
<tr><td colspan="6"><input class="sub-del" type="submit" value=" "><button type="button" class="btn del-btn gen-btn float-right"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete selected message(s)</button></td></tr>
</tbody>
</table>
</form>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
echo "<div class='not-success'>No messages found at the moment.</div>";
}

}

//=======================View Post==============================//
if(!empty($view)){
$result = $db->select("admin_messages", "WHERE id='$view' AND recipient_email = '$gen_email' AND inbox = '1'", "*", "");

if(count_rows($result) == 1){
$row = fetch_data($result);
$subject = $row["subject"];
$message = $row["message"];
$sender_name = $row["sender_name"];
$sender_email = $row["sender_email"];
$date = min_full_date($row["date_time"]);
$sender_phone = $row["sender_phone"];

$db->query("UPDATE admin_messages SET viewed = '1' WHERE id = '{$view}'");
?>

<div class="reply-content-wrapper ">

<div class="back"><a href="<?php echo $admin; ?>general-inbox/pn/<?php echo $pn; ?>/" class="btn gen-btn general-link"><i class="fa fa-arrow-left"></i> Back to general inbox</a></div>

<div class="view-wrapper ">

<div class="view-header ">
<div class="header-img"><img src="images/post.jpg" ></div>
<div class="header-content">
<div class="view-title"><?php echo $subject; ?></div>
<div class="view-title-details">From: <?php echo "{$sender_name} ({$sender_email} - {$sender_phone}) {$date}"; ?></div>
</div>
</div>

<div class="view-content">
<?php echo $message; ?>
</div>

</div>
</div>

<?php
}else{
echo "<div class='not-success'>No messages found at the moment.</div>";
}
}
?>

<script>
<!--
var det_action_title = "delete";
var conf_text = "message";
//-->
</script>

<script src="<?php echo new_version("js/general-form.js"); ?>"></script>

<?php  if(!isset($_REQUEST["gh"])){?>

</div>
</div>

</div>

<?php require_once("../includes/portal-footer.php"); } ?>