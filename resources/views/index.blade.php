@extends('layouts.app')

@section('content')

<style>
<!--
.shadow{
background:#fff;
text-align:center;
padding:5px;
}

.home-bg{
background-image: url({{ asset('images/backgrounds/home-bg.jpg') }});
background-position:top left;
-webkit-background-size: cover; 
-moz-background-size: cover; 
-o-background-size: cover; 
background-size: cover;
background-repeat:no-repeat;
}
.header-wrapper2{
background:rgba(255,255,255,0.7);
border-bottom:0px;
}
.header-wrapper2 .header2 ul li a{
background:rgba(255,255,255,0.2);
}
.header-wrapper2 .header2 ul li a:hover, .header-wrapper2 .header2 ul li a.current{
background:rgba(0,150,0,0.5);
color:#fff!important;
}

.home-bg{
min-height:576px;
}

.services-section{
padding:10px;
margin:10px;
margin-top:30px;
background:rgba(150,0,0,0.8);
}
.services-section h1{
padding:15px;
margin:0px;
background:#b20;
font-weight:900;
font-size:25px;
color:#fff;
}
.services-section h1 i{
font-size:25px;
color:#fff;
}
.services-section ul{
list-style:none;
margin-left:0px;
padding-top:10px;
}
.services-section li{
padding:10px;
color:#fff;
}
.services-section li i{
color:#fff;
}
-->
</style>

<div class="home-body-wrapper home-bg"> 
<div class="container">

<div class="col-md-7">

</div>
<div class="col-md-5" style="padding:0px;">

<div class="services-section border-radius">
<h1 class="border-radius"><i class="fa fa-cogs" aria-hidden="true"></i> Our Services</h1>
<ul>
<li><i class="fa fa-check" aria-hidden="true"></i> Fabrication</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Installation and welding of stainless-steel water line, glycol line, airline</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Construction of divert panel and laying of pipes for fire hydrants with either gas welding or arc welding</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Installation of hand rail and all other structural works such as stair case, rack and pipes bridges, car port</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Supply of steel and plumbing materials</li>
<li><i class="fa fa-check" aria-hidden="true"></i> General contracts</li>
<li style="text-align:center;"><a href="contact" class="btn gen-btn border-radius">Contact Us</a></li>
</ul>
</div>

</div>
</div>
</div>

</div>

<div class="home-body-wrapper"> 
<div class="container">

<!-- Our Recent Projects -->
@if($home_display->count() > 0)
<h1 class="home-adverts-tag">Our Recent Projects</h1>
<x-post-wrapper>
@foreach($home_display as $post)
@php $file_name =  $gen_class::det_image('items-featured/' . $post->id . '_' . $post->posted_by . '_item_featured_*.*', 0) @endphp
<x-post-grid :file_name="$file_name" :post="$post"/>
@endforeach
</x-post-wrapper>
@endif
<!-- Ends Our Recent Projects -->

</div>
</div>

<script>
<!--
$(document).ready(function () {

$("#owl-content").owlCarousel({
autoPlay: 3000,
items : 3,
itemsDesktop : [1199,3],
itemsDesktopSmall : [979,2],
itemsTablet : [540,1]
});

});
//-->
</script>

@endsection