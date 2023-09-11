<x-admin-header :title="$title" :page_slug="$page_slug"> 

<?php /*if(!isset($_REQUEST["gh"])){ require_once("../includes/admin-header.php"); 
}else{ 
include_once("../includes/gen-header.php");
} ?>

<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
ini_set('memory_limit', '5120M');

role_redirect("role_management");

$pn = nr_input("pn");

$add = nr_input("add");
$edit = nr_input("edit");
$delete = np_input("delete");
$role = tp_input("role");

//////////==================== Delete Role(s) =====================/////////////
if(check_privilege("role_management") == 1 && isset($_POST["delete"]) && isset($_POST["del"])){
$i = $act = 0;
$role_text = "";
if(is_array($_POST["del"])){

foreach ($_POST["del"] as $k => $c) {
if($c != ""){ 
$c = testQty($c);
$role_text .= get_table_data("role_management", $c, "role") . ", ";
$db->query("UPDATE users SET role_id = '0' WHERE role_id = '{$c}'");
$act = $db->delete("role_management", "id = '$c'");
$i++;		
}else{
continue;
}
}

if($act && $i > 0){

$role_text = substr($role_text,0,-2);
$activity = "Deleted {$i} role from database: <b>{$role_text}</b>.";
activity_log($id, $username, $user_email, $activity);

echo "<div class='success'>{$i} role(s) successfully deleted.</div>";
}else{
echo "<div class='not-success'>Error. Unable to delete role(s).</div>";
}

}else{
echo "<div class='not-success'>Atleast one role must be selected.</div>";
}
}

//////////////////////////////////=====Create Row============//////////////////////////////////////////
if(check_privilege("role_management") == 1 && $_SERVER['REQUEST_METHOD'] == "POST" && !empty($role) && (!empty($add) || !empty($edit))){

$check_row_exists = in_table("role","role_management","WHERE role='{$role}'","role");

$data_array = array();
$roles_combined = "";
foreach($_POST as $key => $val){
if($key != "add" && $key != "edit" && $key != "gh" && $key != "pn" && $key != "sel-all"){
$data_array += array($key => $val);
$roles_combined .= ($key != "role" && !empty($val))? in_table("role_text","privileges","WHERE role_title='{$key}'","role_text") . ", " : "";
}
}

$act = "";

if(!empty($add) && empty($check_row_exists)){
$data_array += array("date_created" => $date_time, "created_by" => $id);
$act = $db->insert($data_array, "role_management");
}else if(!empty($edit)){
$data_array += array("date_updated" => $date_time, "updated_by" => $id);
$act = $db->update($data_array, "role_management", "id = '$edit'");
}

if($act){
$error = 0;
$roles_combined = substr($roles_combined,0,-2);
$activity = "Allowed the following privileges to a role (<b>{$role}</b>): {$roles_combined}.";
activity_log($id, $username, $user_email, $activity);

echo (!empty($add))?"<div class='success'>Role successfully added.</div>":"<div class='success'>Role successfully updated.</div>";
}else{
if(!empty($add) && !empty($check_row_exists)){
echo "<div class='not-success'>Not successful. This role was previously created.</div>";
}else{
echo (!empty($add))?"<div class='not-success'>Error. Unable to add role.</div>":"<div class='not-success'>Error. Unable to update role.</div>";
}
}

}

////////////////////////////////////////////////////******************************//////////////

/*$result = $db->select("role_management", "", "*", "ORDER BY id DESC");

$per_view = 20;
$page_link = "{$admin}role-management/pn/";
$link_suffix = "/";
$style_class = "general-link";
page_numbers();*/
?>

@if(isset($default))

@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; @endphp

<div class="page-title">Role Management <a href="{{ $gen_class::$admin }}/role-management/create" class="btn gen-btn float-right">New Role</a></div>

<form action="{{ $gen_class::$admin }}/role-management" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="search" value="1" />
<div class="search-dates">
@csrf
@php $prefix = "role-management-" @endphp

<div class="col-md-6">
<label for="keyword">Keyword</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Project title or details" value="{{ session($prefix.'keyword') }}">
</div>
</div>

<div class="col-md-4">
<label for="no_of_rows">No. of Rows</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
<input type="number" name="no_of_rows" id="no_of_rows" class="form-control only-no" placeholder="No. of rows" value="{{ $gen_class::$per_view }}">
</div>
</div>

<div class="col-md-2">
<br />
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-search"></i> Search</button>
</div>

</div>
</form>

@if($gen_class::$count > 0)
@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; $d=0; @endphp
<form action="{{ $gen_class::$admin }}/delete-role" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="overflow-x:auto;">
@csrf
@method('DELETE')
<input type="hidden" name="pn" value="{{$pn}}"> 
 
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th style="width: 40px;">#ID</th>
<th>Role Name</th>
<th>Date Created</th>
<th>Created By</th>
<th>Last Update</th>
<th>Updated By</th>
<th style="width: 100px;">Option</th>
<th style="width:30px;"><input type="checkbox" name="sel_all" id="delG" class="sel-group" value=""></th>
</tr>
</thead>
<tbody>

@foreach($display_few as $post)
@php
$role_id = $post->id;
$role = $post->role;
$date_created = ($post->date_created != "0000-00-00 00:00:00")?$gen_class::min_full_date($post->date_created):"";
$created_by_name = $gen_class::in_table("users",[['id', '=', $post->created_by]],"name");
$created_by_email = $gen_class::in_table("users",[['id', '=', $post->created_by]],"email");
$date_updated = ($post->date_updated != "0000-00-00 00:00:00")?$gen_class::min_full_date($post->date_updated):"";
$updated_by_name = $gen_class::in_table("users",[['id', '=', $post->updated_by]],"name");
$updated_by_email = $gen_class::in_table("users",[['id', '=', $post->updated_by]],"email");
@endphp
<tr>
<td>{{$role_id}}</td>
<td>{{$role}}</td>
<td>{{$date_created}}</td>
<td>{!!"{$created_by_name} <br> ({$created_by_email})"!!}</td>
<td>{{$date_updated}}</td>
<td>{{(!empty($post->updated_by))?"{$updated_by_name} <br> ({$updated_by_email})":""}}</td>
<td><a href="{{ $gen_class::$admin }}/role-management/{{$pn}}/edit/{{$role_id}}" class="btn gen-btn" title="Edit role #{{$role_id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></td>
<td><input type="checkbox" name="del[{{$d}}]" id="del{{$d}}" class="delG" value="{{$role_id}}"></td>
</tr>
@php $d++; @endphp
@endforeach	
<tr><td colspan="9"><input class="sub-del" type="submit" value=" "><button type="button" class="btn del-btn gen-btn float-right"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete selected role(s)</button></td></tr>
</tbody>
</table>
</form>
{!! ($gen_class::$last_page>1)?"<div class=\"page-nos\">" . $gen_class::$center_pages . "</div>":"" !!}
@else
<div class="not-success">No roles found at the moment.</div>
@endif
@endif

{{--$gen_class::check_privilege("role_management") == 1--}}
@if(isset($create) || isset($edit))

@php $role = ""; @endphp
@if(isset($edit))
@php 
$role = $gen_class::in_table("role_management",[['id', '=', $edit]],"role");
@endphp
@endif

@php
$url_add = (!empty($edit))?"/{$pn}/edit/{$edit}":"/create";
$back_add = (!empty($edit))?"/{$pn}":"";
$action_title = (!empty($edit))?"Edit Role #1":"Add New Role";
$c = 0;
@endphp

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
.title_adjust{
font-weight:bold; 
vertical-align:middle !important;
}
.title_adjust *{
font-weight:bold;
}
-->
</style>

<div><a href="{{ $gen_class::$admin }}/role-management{{$back_add}}" class="btn gen-btn float-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to role management</a></div>

<form action="{{ $gen_class::$admin }}/role-management{{$url_add}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<div class="body-header">{{$action_title}}</span></div>    

@csrf

@if(isset($edit))
@method('PUT')
<input type="hidden" name="edit" value="{{$edit}}"> 
<input type="hidden" name="pn" value="{{$pn}}"> 
@endif

<div class="overflow">
<table class="table table-striped table-hover">
<tr><td></td><td class="title_adjust" style="text-align:right!important;"><label for="role">Role Name:</label></td><td colspan="2"><input type="text" name="role" id="role" class="form-control" placeholder="Type the role name" required value="{{$gen_class::check_inputted("role", $role)}}">
</td><td></td><td></td><td class="title_adjust"><input type="checkbox" name="sel-all" id="delG" class="sel-group" value=""></td><td class="title_adjust"><label for="delG">Select all</label></td></tr>
<tr>

@foreach($post as $post)
@php
$c++;
$role_id = $post->id;
$role_title = $post->role_title;
$role_text = $post->role_text;
@endphp

<td class="field_td"><input type="hidden" name="{{$role_title}}" id="{{$role_title}}1" value="0"><input type="checkbox" name="{{$role_title}}" id="{{$role_title}}" class="delG" value="1"{{(isset($edit))?$gen_class::role_exists($edit, $role_title):""}}></td>
<td><label for="{{$role_title}}">{{$role_text}}</label></td>

@if($c == 4)
</tr><tr>
@php $c = 0; @endphp
@endif

@endforeach

@if($c > 0 && $c < 4)
<td colspan="{{(4 - $c) * 2}}"></td>
@endif
</tr>
</table>
</div>

<div class="col-sm-12">
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> {{(!empty($add))?"Add role":"Update role"}}</button>
</div>
</form>
              
@endif

<script>
<!--
var det_action_title = "delete";
var conf_text = "role";
//-->
</script>

<script src="{{ asset('js/general-form.js') }}"></script>

</div>
</div>

</div>


</div>
</div>

</div>

</x-admin-header> 