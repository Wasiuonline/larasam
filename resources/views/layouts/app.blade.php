@php
/*require_once("classes/db-class.php");
require_once("includes/functions.php");

require_once("includes/mobile-detect.php");
$detect = new Mobile_Detect;*/

date_default_timezone_set("Africa/Lagos");

function detectCurrUserBrowser($a,$b,$c){
$msie = stripos($_SERVER["HTTP_USER_AGENT"], "msie") ? true : false;
if($msie){ 
$msiePosition = stripos($_SERVER["HTTP_USER_AGENT"], "msie");
$msiePositionNew = $msiePosition+5;
$versionNumber = substr($_SERVER["HTTP_USER_AGENT"],$msiePositionNew,1);
if($versionNumber <= $c){
echo $a;
}
else{
echo $b;
}
}
else{
echo $b;
}
}

$det_cat_slug = "";
@endphp

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
<?php //include_once("includes/analyticstracking.php"); ?>

<base href="/" target="_top">
<meta charset="UTF-8" />
<meta name="description" content="A technical service company, {{ url('/') }}"/>
<meta name="robots" content="noodp"/>
<meta name="keywords" content="A technical service company in Lagos Nigeria, {{ url('/') }}, {{ config('app.name') }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>{{ $title }} | {{ config('app.name') }}</title>

<meta property="og:site_name" content="A technical service company | {{ config('app.name') }}"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:url" content="{{ url('/') }}" /> 
<meta property="og:type" content="website" />
<meta property="og:title" content="A technical service company | {{ config('app.name') }}" /> 
<meta property="og:description" content="A technical service company" /> 
<meta property="og:image" content="{{ asset('images/logos/samvick-general-logo.png') }}" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:width" content="210" />
<meta property="og:image:height" content="210" />

<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<style>
<!--
.shadow{
background:#fff;
text-align:center;
padding:5px;
}
.home-body-wrapper .container{
min-height:400px;
}
.modal-body ol, .modal-body ul{
margin-left:20px;
}
-->
</style>

</head>
@php detectCurrUserBrowser('<table width="100%"><tr><td>','',7); @endphp
<body>

@auth
<div class="header-wrapper header-wrapper1" id="bodyDiv">
<div class="header header1">
<ul class="top-ul">
@if($gen_class::gen("is_admin"))
<li><a onClick="javascript:my_confirm('Logout Confirmation','Are you sure you want to log out?','/logout');"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
<li><a href="{{$gen_class::$admin}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Admin Dashboard</a></li>
@endif

<!--<li><a href="register"><i class="fa fa-laptop" aria-hidden="true"></i> Register</a></li>
<li><a href="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>-->

</ul>
</div>
</div>
@endauth

<div class="home-bg">

<div class="header-wrapper header-wrapper2">
<div class="header header2">
<a href="{{ url('/') }}" class="logo-link float-left"><img src="{{ asset('images/logos/samvick-logo.png') }}"></a>
<button class="collapse"><span></span><span></span><span></span></button>
<ul class="main-list">
<li><a href="about" class="{{ $gen_class::current_page('about', $page_slug) }}">Our Company</a></li>
<li><a href="{{ route('service') }}" class="{{ $gen_class::current_page('services', $page_slug) }}">Our Services</a></li>
<li><a href="projects-photos" class="{{ $gen_class::current_page('projects-photos', $page_slug) }}">Projects Photos</a></li>
<li><a href="contact" class="{{ $gen_class::current_page('contact', $page_slug) }}">Contact</a></li>
</ul>
</div>
</div>

<x-message/>

@yield('content')

<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">

<div class="general-fade"></div>

<div class="general-result"></div>

<div class="footer-container">
<div class="footer-wrapper">
<div class="footer container">

<div class="col-sm-5 nav-link share">
<div class="title btn">CONTACT US</div>
<p><a href="mailto:{{ $gen_class::$gen_email }}"><b>Email:</b> {{ $gen_class::$gen_email }}</a></p>
<p><a href="tel:+2348063209539"><b>Phone:</b> {{ $gen_class::$gen_phone }}</a></p>
<p><b>Contact Office:</b> 30, Abata Street, Orile Iganmu, Lagos.</p>
</div>

<div class="col-sm-3 nav-link">
<div class="title btn">QUICK LINKS</div>
<a href="/" class="{{ $gen_class::current_page('index', $page_slug) }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
<a href="about" class="{{ $gen_class::current_page('about', $page_slug) }}"><i class="fa fa-university" aria-hidden="true"></i> About Us</a>
<a href="contact" class="{{ $gen_class::current_page('contact', $page_slug) }}"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
<a href="services" class="{{ $gen_class::current_page('services', $page_slug) }}"><i class="fa fa-cogs" aria-hidden="true"></i> Services</a>
<a href="projects-photos" class="{{ $gen_class::current_page('projects-photos', $page_slug) }}"><i class="fa fa-file-image-o" aria-hidden="true"></i> Past Projects</a>
</div>

<div class="col-sm-4">
<div class="title btn">ABOUT US</div>
<p><b>SamVick Technical Services Limited</b> is a company with years of experience in gas welding (argon) and Arc welding of all kinds of steel. Such as stainless steel, mild steel, galvanize aluminum etc as well as supply of materials. <a href="about/" style="color:#ff5;">Read more...</a></p>
</div>

</div>
</div>
</div>

<div class="copyright">Copyright &copy; @php echo date("Y") . " " . $gen_class::$full_gen_name; @endphp. All Rights Reserved.<br />Developed by: <a href="http://reliancewisdom.com" target="_blank">Reliance Wisdom Digital.</a></div>

<script type="text/javascript" src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/general-form.js') }}"></script>
</body>
@php detectCurrUserBrowser('</td></tr></table>','',7); @endphp
</html>