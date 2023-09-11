<x-admin-header :title="$title" :page_slug="$page_slug"> 

@if(isset($default))
<style>
<!--
.description-title{
color:#f11;
margin-top:0px;
margin-bottom:5px;
}
-->
</style>

<div class="page-title">Manage Projects Photos <a href="{{ $gen_class::$admin }}/manage-projects-images/create" class="btn gen-btn float-right">Post New Project</a></div>

<form action="{{ $gen_class::$admin }}/manage-projects-images" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="search" value="1" />
<div class="search-dates">
@csrf
@php $prefix = "manage-projects-images-" @endphp

<div class="col-md-4">
<label for="keyword">Keyword</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Project title or details" value="{{ session($prefix.'keyword') }}">
</div>
</div>

<div class="col-md-2">
<label for="no_of_rows">No. of Rows</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
<input type="number" name="no_of_rows" id="no_of_rows" class="form-control only-no" placeholder="No. of rows" value="{{ $gen_class::$per_view }}">
</div>
</div>

<div class="col-md-2">
<label for="search_start_date">Start Date</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="search_start_date" id="search_start_date" class="form-control gen-date" placeholder="YYYY-MM-DD" value="{{ session($prefix.'search_start_date') }}">
</div>
</div>

<div class="col-md-2">
<label for="search_end_date">End Date</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="search_end_date" id="search_end_date" class="form-control gen-date" placeholder="YYYY-MM-DD" value="{{ session($prefix.'search_end_date') }}">
</div>
</div>

<div class="col-md-2">
<br />
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-search"></i> Search</button>
</div>

</div>
</form>

@if($gen_class::$count > 0)
@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; @endphp
<form action="{{ $gen_class::$admin }}/delete-projects-posts" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="overflow-x:auto;">
@csrf
@method('DELETE')
<input type="hidden" name="pn" value="{{$pn}}"> 
<table class="table">
<thead>
<tr>
<th class="align-right">Select all</th>
<th style="width:30px;"><input type="checkbox" name="sel_all" id="delG" class="sel-group" value=""></th>
</tr>
</thead>
<tbody>
@php $d=0; $pn=$gen_class::$pn; @endphp
@foreach($display_few as $post)
@php
$item_id = $post->id;
$project_date = $gen_class::sub_date($post->project_date);
$title = $post->title;
$location = $post->location;
$date_posted = $gen_class::full_date($post->date_posted);
$posted_by = $post->posted_by;
$item_file =  $gen_class::det_image('items-featured/' . $post->id . '_' . $post->posted_by . '_item_featured_*.*', 0);
@endphp
<tr>
<td style="padding:0px;">
<div class="reply-content-wrapper" style="padding:0px; padding-top:5px; padding-bottom:5px;">
<div class="view-wrapper" style="border:0px;">

<div class="view-header" style="border:0px;">
<div class="header-content">
<div class="view-title">{{$title}}</div>
<div class="view-title-details"><i class="fa fa-calendar" aria-hidden="true"></i> {{$date_posted}}</div>
</div>
</div>

<div>
<div class="col-sm-3" style="padding:5px;">
<img src="{{asset($item_file)}}">
</div>
<div class="col-sm-9" style="padding:5px;">

<div class="col-sm-6" style="padding:2px;">
<h3 class="description-title">Project Date</h3>
<p><i class="fa fa-calendar" aria-hidden="true"></i> {{$project_date}}</p>
</div>
<div class="col-sm-6" style="padding:2px;">
<h3 class="description-title">Location</h3>
<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$location}}</p>
</div>
<div class="col-sm-12" style="padding:2px; padding-top:20px;">
<a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}/edit/{{$item_id}}" class="btn btn-success float-right" title="Edit project #{{$item_id}}"><i class="fa fa-pencil" aria-hidden="true" style="color:#fff;"></i> Edit</a>
<a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}/view/{{$item_id}}" class="btn btn-danger float-right" title="View project photo #{{$item_id}}" style="margin-right:10px;"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
<a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}/change/{{$item_id}}" class="ajax-link btn btn-primary float-right" title="Change project #{{$item_id}} picture" style="margin-right:10px;"><i class="fa fa-refresh" aria-hidden="true" style="color:#fff;"></i> Change</a>
</div>

</div>
</div>


</div>


</div>
</td>
<td><input type="checkbox" name="del[{{$d}}]" id="del{{$d}}" class="delG" value="{{$item_id}}"></td>
</tr>
@php $d++; @endphp
@endforeach	
<tr><td colspan="2"><input class="sub-del" type="submit" value=" "><button type="button" class="btn del-btn gen-btn float-right"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete selected project(s)</button></td></tr>
</tbody>
</table>
</form>

{!! ($gen_class::$last_page>1)?"<div class=\"page-nos\">" . $gen_class::$center_pages . "</div>":"" !!}

@else
<div class="not-success">No project photos found at the moment.</div>
@endif

@endif

@if(isset($view))
@if($post)
@php
$item_id = $post->id;
$project_date = $gen_class::sub_date($post->project_date);
$title = $post->title;
$location = $post->location;
$details = $post->details;
$date_posted = $gen_class::full_date($post->date_posted);
$posted_by = $post->posted_by;
$poster_name = $gen_class::in_table("users",[['id', '=', $posted_by]],"name");
$poster_email = $gen_class::in_table("users",[['id', '=', $posted_by]],"email");

$slide_array1 = $gen_class::det_all_images("items-featured/{$item_id}_{$posted_by}_item_featured_*.*");
$slide_array2 = $gen_class::det_all_images("items-displayed/{$item_id}_{$posted_by}_item_displayed_*.*");
@endphp

<link rel="stylesheet" href="{{asset('css/fotorama.css')}}">
<script src="{{asset('js/fotorama.js')}}"></script>

<div class="reply-content-wrapper">

<div class="back"><a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to project photos</a></div>

<div class="view-wrapper ">

<div class="view-header ">
<div class="header-content">
<div class="view-title">{{"{$title} (#{$item_id})"}}</div>
<div class="view-title-details">Posted by: {{"{$poster_name} ({$poster_email})"}} on {{$date_posted}}</div>
</div>
</div>

<div class="view-content">

<div class="col-md-7">

@if($slide_array2 && count($slide_array2) > 1)
<div class="fotorama" data-width="600" data-ratio="2.5/2" data-nav="thumbs" data-thumbheight="48">
@php $c = 0; @endphp
@foreach($slide_array2 as $val)
@php
$file_session_no_arr = explode("_",$val);
$file_session_no = $file_session_no_arr[4];
$picture_description = $gen_class::in_table("sub_project_photos",[['project_id', '=', $item_id],['file_session_no', '=', $file_session_no]],"picture_description");
@endphp
<a href="{{$val}}" data-caption="{{$picture_description}}"><img src="{{ (file_exists(public_path($slide_array1[$c])))?$slide_array1[$c]:'' }}"></a>
@php $c++; @endphp
@endforeach
</div> 
@else 
@php $val = (isset($slide_array2[0]))?$slide_array2[0]:""; @endphp
@if($val)
@php
$file_session_no_arr = explode("_",$val);
$file_session_no = $file_session_no_arr[4];
$picture_description = $gen_class::in_table("sub_project_photos",[['project_id', '=', $item_id],['file_session_no', '=', $file_session_no]],"picture_description");
@endphp
<div><img src="{{$val}}"></div>
<div class="single-fotorama-description">{{$picture_description}}</div>
@endif
@endif

</div>
<div class="col-md-5">

<h3 class="description-title">Project Date</h3>
<p><i class="fa fa-calendar" aria-hidden="true"></i> {{$project_date}}</p>

<h3 class="description-title">Location</h3>
<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$location}}</p>

@if(!empty($details))
<h3 class="description-title">Details</h3>
{{$details}}
@endif

<div><a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}/edit/{{$item_id}}" class="gen-btn float-right" title="Edit project #{{$item_id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></div>

</div>


</div>

</div>
</div>

@else
<div class='not-success'>No project photos found at the moment.</div>
@endif
@endif


@if(isset($change))
@if($post)
@php
$item_id = $post->id;
$user_id = $post->posted_by;
$file_name_aray = $gen_class::det_all_images("items-featured/{$item_id}_{$user_id}_item_featured_*.*");
@endphp
<style>
<!--
.project-wrapper{
margin-bottom:10px;
}
.btn-primary *{
color:#fff;
}
-->
</style>

<div><a href="{{ $gen_class::$admin }}/manage-projects-images/{{$pn}}" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to project photos</a></div>

<div class="page-title">Change Project #{{$item_id}} Picture(s)</div>

<div class="col-md-12">
<p class="img-notice"><b>Format:</b> .jpg, .jpeg, .png, .gif. Not more than 20MB<br /> <b>Note:</b> The first image is your featured image which displays first as grid.</p>

<div class="add-result">

@if($file_name_aray && count($file_name_aray) > 0)
@foreach($file_name_aray as $val)
@if(file_exists(public_path($val)))
@php
$file_session_no_arr = explode("/",$val);
$file_session_name = end($file_session_no_arr);
$file_session_no_arr = explode("_",$file_session_name);
$file_session_no = $file_session_no_arr[4];
$picture_description = $gen_class::in_table("sub_project_photos",[['project_id', '=', $item_id],['file_session_no', '=', $file_session_no]],"picture_description");
$picture_description_id = $gen_class::in_table("sub_project_photos",[['project_id', '=', $item_id],['file_session_no', '=', $file_session_no]],"id");
@endphp
<div id="result2-{{$file_session_no}}" class="project-wrapper">
<div class="col-xs-4 col-sm-4 col-md-3" style="padding:0px;">      

<form action="process-data/change-project-image" id="result-{{$file_session_no}}" class="general-change-form edit-form-{{$file_session_no}}" name="my-item-default-{{$file_session_no}}" lang="my-item-loading-{{$file_session_no}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
@csrf
<input type="hidden" name="edit_my_item_img2" value="1" />
<input type="hidden" name="item_user_id" value="{{$user_id}}" />
<input type="hidden" name="item_id" value="{{$item_id}}" />
<input type="hidden" name="session_item_img" value="{{$file_session_no}}" />

<div class="new-item-pic">
<div class="item-pic-img"> 
<div class="relative-div">
<div class="item-pic-option"> 
<label for="edit_item_img_{{$file_session_no}}" class="fileupload-new float-left" title="Change picture">
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-item-loading-{{$file_session_no}}"></i>
<i class="fa fa-refresh" aria-hidden="true" id="my-item-default-{{$file_session_no}}"></i>                          
</label>
<button type="button" title="Delete picture" class="delete-item-picture" onclick="javascript: delete_file('process-data/delete-changed-project-image', 'del_item_file2', '{{$file_session_name}}', 'delete-{{$file_session_no}}', 'result2-{{$file_session_no}}');"><i class="fa fa-trash" aria-hidden="true"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-{{$file_session_no}}" aria-hidden="true"></i></button>
</div>
<div class="item-image-wrapper result-{{$file_session_no}}">
<div class="item-image-bg" style="background:url({{$val}}) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn-file upload-padding">
<input type="file" name="edit_item_img" id="edit_item_img_{{$file_session_no}}" onchange="javascript: $('.edit-form-{{$file_session_no}}').submit();" accept="image/*">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
</div>
</form>
</div>
<div class="col-sm-8 col-xs-8  col-md-9 picture-description">
<div class="inline-picture-description-{{$file_session_no}} reset-row"><div class="float-left">{{$picture_description}}</div> <a class="btn btn-danger float-right" onclick="javascript: $('.inline-picture-description-{{$file_session_no}}').hide(); $('.inline-picture-form-{{$file_session_no}}').slideToggle();" style="margin:5px;"><i class="fa fa-pencil"></i> Edit</a></div>
<form action="process-data/change-project-description" class="change-description reset-row inline-picture-description inline-picture-form-{{$file_session_no}}" id="inline-picture-description-{{$file_session_no}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" onsubmit="javascript: $('.inline-picture-form-{{$file_session_no}}').hide(); $('.inline-picture-description-{{$file_session_no}}').slideToggle();">  
@csrf
@method('PUT')
<input type="hidden" name="picture_description_update_id" value="{{$picture_description_id}}">
<textarea name="picture_description_update" class="form-control" placeholder="Enter the picture description" rows="2" >{{$picture_description}}</textarea>
<div class="submit-div">
<button class="btn gen-btn float-right" type="submit" style="margin-left:10px; margin-bottom:5px;"><i class="fa fa-upload"></i> Update</button> <a class="btn btn-primary float-right" style="margin-bottom:5px;" onclick="javascript: $('.inline-picture-form-{{$file_session_no}}').hide(); $('.inline-picture-description-{{$file_session_no}}').slideToggle();"><i class="fa fa-arrow-left"></i> Exit edit</a>
</div>
</form>
</div>
</div>
@endif
@endforeach
@endif

</div>
</div>

@else
<div class="not-success">No project photos found at the moment.</div>
@endif
@endif


@if(isset($create) || isset($edit))

@php $item_id = $project_date = $title = $title_slug = $location = $details = ""; @endphp
@if(isset($edit))
@if($post)
@php 
$item_id = $post->id;
$project_date = $post->project_date;
$title = $post->title;
$title_slug = $post->title_slug;
$location = $post->location;
$details = $post->details;
@endphp
@endif
@endif

@php
$url_add = (!empty($edit))?"/{$pn}/edit/{$edit}":"/create";
$back_add = (!empty($edit))?"/{$pn}":"";
$action_title = (!empty($edit))?"Edit":"Add New";
$img_title = (!empty($edit))?"Add More Picture(s)":"Add New Picture(s)<span class=\"required\">*</span>";
//print_r(session("item_img_description")); echo "<br />";  print_r(session("item_img"))
@endphp

<style>
<!--
.error-indicator{
border:1px solid #d00;
margin-bottom:10px;
padding-top:5px;
}
.error-message{
color:#d00;
font-size:12px;
margin-bottom:10px;
}
-->
</style>

<div><a href="{{ $gen_class::$admin }}/manage-projects-images{{$back_add}}" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to project photos</a></div>

<div class="page-title">{{$action_title}} Project</div>

<div>
<div class="col-md-6">
<label for="" style="padding-top:20px;"><b>{!!$img_title!!}</b></label>
<p class="img-notice"><b>Format:</b> .jpg, .jpeg, .png, .gif. Not more than 20MB<br /> <b>Note:</b> The first image is your featured image which displays first as grid.<br />Also, you can ONLY upload maximum of five (5) pictures.</p>

<div class="add-result">

@if(session("item_img") != null)
@foreach(session("item_img") as $key => $val)
@php
$file_name = $gen_class::det_image("items-temp/" . auth()->user()->id . "_item_featured_{$val}_*.*", 0); 
$picture_description = session("item_img_description")[$val];
@endphp

<div id="result2-{{$val}}" class="project-wrapper">
<div class="col-sm-4 col-xs-6" style="padding:0px;">      

<form action="process-data/edit-project-image" title="Item picture" id="result-{{$val}}" class="general-form2 edit-form-{{$val}}" name="my-item-default-{{$val}}" lang="my-item-loading-{{$val}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
@csrf
<input type="hidden" name="edit_my_item_img" value="1" />
<input type="hidden" name="session_item_img" value="{{$val}}" />
<div class="new-item-pic">
<div class="item-pic-img"> 
<div class="relative-div">
<div class="item-pic-option"> 
<label for="edit_item_img_{{$val}}" class="fileupload-new float-left" title="Change picture">
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" aria-hidden="true" id="my-item-loading-{{$val}}"></i>
<i class="fa fa-refresh" aria-hidden="true" id="my-item-default-{{$val}}"></i>                          
</label>
<button type="button" title="Delete picture" class="delete-item-picture" onclick="javascript: delete_file('process-data/delete-project-image', 'del_item_file', '{{$val}}', 'delete-{{$val}}', 'result2-{{$val}}');"><i class="fa fa-trash" aria-hidden="true"></i> <i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner" id="delete-{{$val}}" aria-hidden="true"></i></button>
</div>
<div class="item-image-wrapper result-{{$val}}">
<div class="item-image-bg" style="background:url({{$file_name}}) left top no-repeat; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"></div>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn-file upload-padding">
<input type="file" name="edit_item_img" id="edit_item_img_{{$val}}" onchange="javascript: $('.edit-form-{{$val}}').submit();" accept="image/*">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
</div>
</form>
</div>
<div class="col-sm-8 col-xs-6 picture-description">{{$picture_description}}</div>
</div>
@endforeach
@endif
</div>

<!-- general-form2  -->
<form action="process-data/upload-project-image" class="general-form2 add-form" name="my-item-default" id="add-result" lang="my-item-loading" title="add" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  
@csrf
<input type="hidden" name="my_item_img" value="1" />
<label for="picture_description" style="margin-top:20px;">Picture Description <span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
<textarea name="picture_description" id="picture_description" class="form-control" placeholder="Enter the picture description" rows="2" required></textarea>
</div>
<div class="new-item-pic">
<div class="item-pic-img"> 
<div class="relative-div">
<div class="item-image-wrapper" style="width:100%; height:auto;">Add new picture</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
<span class="btn btn-primary btn-file upload-padding">
<span class="fileupload-new">
<i class="fa fa-plus-circle" aria-hidden="true" id="my-item-default"></i> 
<i class="fa fa-spinner fa-spin fa-3x fa-fw gen-spinner my-item-loading" aria-hidden="true" id="my-item-loading"></i>
</span>
<input type="file" name="item_img" onchange="javascript: $('.add-form').submit();" accept="image/*">
</span><span class="fileupload-preview"></span>
</div></div>
</div>
<div class="item-pic-option"> 
</div>
</div>
</form>

</div>
<div class="col-md-6" style="padding:2px;">

<form action="{{ $gen_class::$admin }}/manage-projects-images{{$url_add}}" method="post" runat="server" id="post-form" autocomplete="off" enctype="multipart/form-data" style="border:1px solid #eee;">
@csrf

@if(isset($edit))
@method('PUT')
<input type="hidden" name="edit" value="{{$edit}}"> 
<input type="hidden" name="pn" value="{{$pn}}"> 
@endif

<label for="project_date">Project Date<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
<input type="text" name="project_date" id="project_date" class="form-control gen-date" onfocus="javascript: $(this).blur();" placeholder="YYYY-MM-DD" value="{{$gen_class::check_inputted('project_date', $project_date)}}" required>
</div>
@error('project_date')
<p class="required">{{$message}}</p>
@enderror

<label for="title">Project Title<span class="required">(Keep it short) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
<input type="text" name="title" id="title" class="form-control" placeholder="Enter the project title" value="{{$gen_class::check_inputted('title', $title)}}" required>
</div>
@error('title')
<p class="required">{{$message}}</p>
@enderror

<label for="title_slug">Title Slug<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
<input type="text" name="title_slug" id="title_slug" class="form-control" placeholder="E.g. the-mandate-project" value="{{$gen_class::check_inputted('title_slug', $title_slug)}}" required>
</div>
@error('title_slug')
<p class="required">{{$message}}</p>
@enderror

<label for="location">Project Location<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<textarea name="location" id="location" class="form-control" placeholder="Enter the project full address" rows="2" required>{{$gen_class::check_inputted('location', $location)}}</textarea>
</div>
@error('location')
<p class="required">{{$message}}</p>
@enderror

<label for="details">Project Details <span class="required">(Optional)</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text"></i></span>
<textarea name="details" id="details" class="form-control" placeholder="Enter the project details" rows="2">{{$gen_class::check_inputted('details', $details)}}</textarea>
</div>
@error('location')
<p class="details">{{$message}}</p>
@enderror
                    
<div>
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Save</button>
</div>

</form>
</div>
</div>
<script src="{{ asset('js/text_plugin/ckeditor.js') }}"></script>
<script>
<!--
CKEDITOR.replace("details", {
height: 300,
disallowedContent : "img{width, height}[width, height]"
});

$(document).ready(function(){

$("#post-form").submit(function(){
$("#details").val(CKEDITOR.instances.body.getData());
});

});

//-->
</script>
@endif

<script src="{{ asset('js/general-form.js') }}"></script>

<script>
<!--
var conf_text = "project";
//-->
</script>


</div>
</div>

</div>

</x-admin-header> 