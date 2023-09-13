@extends('layouts.app')

@section('content')

<div class="home-body-wrapper"> 
<div class="container">

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

<link rel="stylesheet" href="{{asset('css/fotorama.css')}}">
<script src="{{asset('js/fotorama.js')}}"></script>

<div class="col-md-7 remove-overflow">

@if($slide_array2 && count($slide_array2) > 1)
<div class="fotorama" data-width="600" data-ratio="2.5/2" data-nav="thumbs" data-thumbheight="48">
@php $c = 0; @endphp
@foreach($slide_array2 as $val)
@php
$file_session_no_arr = explode("_",$val);
$file_session_no = $file_session_no_arr[4];
$picture_description = $gen_class::in_table("sub_project_photos",[['project_id', '=', $item_id],['file_session_no', '=', $file_session_no]],"picture_description");
@endphp
<a href="{{asset($val)}}" data-caption="{{$picture_description}}"><img src="{{ (file_exists(public_path($slide_array1[$c])))?asset($slide_array1[$c]):'' }}"></a>
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
<div><img src="{{asset($val)}}"></div>
<div class="single-fotorama-description">{{$picture_description}}</div>
@endif
@endif

@if(!empty($details))
<h3 class="description-title">Details</h3>
{{$details}}
@endif

</div>
<div class="col-md-5">

<h3 class="description-title">Event Date</h3>
<p><i class="fa fa-calendar" aria-hidden="true"></i> {{$project_date}}</p>

<h3 class="description-title">Location</h3>
<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$location}}</p>

<hr style="border:#dde 1px solid" />

<div class="share-buttons border-radius">
<h3 class="description-title">Share ad on:</h3>
<a href="https://www.facebook.com/sharer.php?u={{url()->full()}}" class="btn btn-primary" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
<a href="https://twitter.com/intent/tweet?url={{url()->full()}}&text={{urlencode($title)}}" class="btn btn-success" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
<a href="https://plus.google.com/share?url={{url()->full()}}" class="btn btn-danger" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a>
<a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->full()}}&title={{urlencode($title)}}&summary=<?php echo urlencode(strip_tags($details)); ?>&source=" class="btn  btn-primary" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a>
<a href="https://pinterest.com/pin/create/button/?url={{url()->full()}}&media={{url($slide_array1[0])}}&description={{urlencode($title)}}" class="btn btn-danger" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</a>
<a href="https://api.whatsapp.com/send?text={{url()->full()}}" class="btn btn-success" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
</div>


</div>
</div>

<!-- Related Projects -->
@if($related_posts->count() > 0)
<h1 class="home-adverts-tag">Related Projects</h1>
<x-post-wrapper>
@foreach($related_posts as $post)
@php $file_name =  $gen_class::det_image('items-featured/' . $post->id . '_' . $post->posted_by . '_item_featured_*.*', 0) @endphp
<x-post-grid :file_name="$file_name" :post="$post"/>
@endforeach
</x-post-wrapper>
@endif
<!-- Ends Related Projects -->

</div>
</div>

@else
<div style="padding-left:10px;"><a onclick="javascript: history.back(1);" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back</a></div>
<div class="not-success">This project does not exist.</div>
@endif

</div>
</div>

@endsection