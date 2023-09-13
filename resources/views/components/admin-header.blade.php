<?php
// Date in the past
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set("session.cookie_lifetime", 86400);
ini_set("session.gc_maxlifetime", 86400);
session_start();

error_reporting(E_ALL); ini_set('display_errors', 1);
ini_set('memory_limit', '5120M');

require_once("../classes/db-class.php");
require_once("functions.php");

if(empty($id)){
$_SESSION["msg2"] = "<div class='not-success'>You are not logged in. Kindly log in to continue...</div>";
$_SESSION["prev_url"] = $actual_link;
redirect($directory . "back/");
}else if(isset($_REQUEST["logout"])){
unset($_SESSION);
session_destroy();
$db->query("UPDATE {$users_tb} SET logged_in = '0' AND last_login = '$date_time' WHERE email = '{$user_email}'");
session_start();
$_SESSION["msg"] = "<div class='success'>You are successfully loged out. Kindly log in to continue...</div>";

redirect("{$directory}back/");
}else if($blocked == 1){
unset($_SESSION);
session_destroy();
session_start();
$_SESSION["msg"] = "<div class='not-success'>Hi {$user_name}! Your account is declined. Kindly contact the admin <a href='{$directory}contact/'>HERE</a>.</div>";
redirect($directory);
}else if(empty($is_admin)){
redirect($directory);
}
*/
?>

@props(['title', 'page_slug'])

@php

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

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<base href="{{url('/')}}" target="_top">
<meta charset="UTF-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>{{ $title }} | {{ config('app.name') }}</title>
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>

<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('css/portal.css') }}" />
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<style>
<!--
.blue-payment{
color:#fff;
background:#06f;
border:1px solid #06f;
}
.blue-payment:hover, .blue-payment:hover *{
color:#01a;
background:#fff;
}

.red-payment{
color:#fff;
background:#b20;
border:1px solid #b20;
}
.red-payment:hover, .red-payment:hover *{
color:#b20;
background:#fff;
}

.gold-payment{
color:#fff;
background:#d47506;
border:1px solid #d47506;
}
.gold-payment:hover, .gold-payment:hover *{
color:#a14203;
background:#fff;
}

.black-payment{
color:#fff;
background:#111;
border:1px solid #111;
}
.black-payment:hover, .black-payment:hover *{
color:#111;
background:#fff;
}

.blue-payment, .red-payment, .gold-payment, .black-payment{
margin:5px;
margin-top:0px;
}

.advisor-note{
font-style:italic;
font-weight:900;
color:#000;
}

.subcription-alert{
font-size:20px!important; 
font-weight:900;
padding-top:50px;
text-align:center;
}
-->
</style>
</head>
@php detectCurrUserBrowser('<table width="100%"><tr><td>','',7); @endphp
<body>

<div class="upper-nav-wrapper" id="bodyDiv">
<div class="upper-nav">
<b style="font-size:18px;">ADMIN PORTAL</b>
<ul>
<li><a onClick="javascript:my_confirm('Logout Confirmation','Are you sure you want to log out?','/logout');">Logout</a></li>
</ul>
</div>
</div>

<div class="header-wrapper">
<div class="header">
<a href="/" class="logo-link"><img src="{{ asset('images/logos/samvick-logo.png') }}"></a>
<span>
@php $file_name = $gen_class::det_image('users/' . auth()->user()->id . 'pic*.*', 0); @endphp
<a href="{{ $gen_class::$admin }}/profile"><img src="{{asset($file_name)}}" ><br>
<i class="fa fa-user" aria-hidden="true"></i> {{auth()->user()->name}}</a>
</span>
<button class="collapse"><span></span><span></span><span></span></button>
</div>
</div>

<div class="portal-wrapper">

<div class="portal-nav portal-content">

<a id="dashboard-menu" class="main-menu {{ (!empty($gen_class::current_page('index', $page_slug)))?'main-current':'' }}"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
<div id="dashboard-menu-div" class="sub-menu">
<a href="{{ $gen_class::$admin }}" class="{{ $gen_class::current_page('index', $page_slug) }}"><i class="fa fa-user" aria-hidden="true"></i> Admin Dashboard</a>
<a href="{{ $gen_class::$users }}"><i class="fa fa-user" aria-hidden="true"></i> Users Portal</a>
</div>

@if($gen_class::check_privilege("manage_admin_users") == 1 || $gen_class::check_privilege("manage_registered_users") == 1 || $gen_class::check_privilege("manage_newsletter_subscribers") == 1 || $gen_class::check_privilege("role_management") == 1)
<a id="setup-menu" class="main-menu {{ (!empty($gen_class::current_page('manage-admin', $page_slug)) || !empty($gen_class::current_page('manage-customers', $page_slug)) || !empty($gen_class::current_page('newsletter-subscribers', $page_slug)) || !empty($gen_class::current_page('role-management', $page_slug)))?'main-current':'' }}"><i class="fa fa-diamond" aria-hidden="true"></i> Setup</a>
<div id="setup-menu-div" class="sub-menu">
@if($gen_class::check_privilege("manage_admin_users") == 1)
<a href="{{ $gen_class::$admin }}/manage-admin" class="{{ $gen_class::current_page('manage-admin', $page_slug) }}"><i class="fa fa-user" aria-hidden="true"></i> Manage Admin</a>
@endif @if($gen_class::check_privilege("manage_registered_users") == 1)
<a href="{{ $gen_class::$admin }}/manage-customers" class="{{ $gen_class::current_page('manage-customers', $page_slug) }}"><i class="fa fa-users" aria-hidden="true"></i> Manage Customers</a>
@endif @if($gen_class::check_privilege("manage_newsletter_subscribers") == 1)
<a href="{{ $gen_class::$admin }}/newsletter-subscribers" class="{{ $gen_class::current_page('newsletter-subscribers', $page_slug) }}"><i class="fa fa-users" aria-hidden="true"></i> Subscribers</a>
@endif @if($gen_class::check_privilege("role_management") == 1)
<a href="{{ $gen_class::$admin }}/role-management" class="{{ $gen_class::current_page('role-management', $page_slug) }}"><i class="fa fa-user" aria-hidden="true"></i> Role Management</a>
@endif
</div>
@endif

@if($gen_class::check_privilege("manage_project_photos") == 1)
<a id="posts-menu" class="main-menu {{ (!empty($gen_class::current_page('manage-projects-images', $page_slug)))?'main-current':'' }}"><i class="fa fa-upload" aria-hidden="true"></i> Posts</a>
<div id="posts-menu-div" class="sub-menu">
@if($gen_class::check_privilege("manage_project_photos") == 1)
<a href="{{ $gen_class::$admin }}/manage-projects-images" class="{{ $gen_class::current_page('manage-projects-images', $page_slug) }}"><i class="fa fa-picture-o"></i> Projects Photos</a>
@endif
</div>
@endif

@if($gen_class::check_privilege("manage_general_inbox") == 1 || $gen_class::check_privilege("send_emails"))
<a id="messages-menu" class="main-menu {{ (!empty($gen_class::current_page('general-inbox', $page_slug)) || !empty($gen_class::current_page('new-message', $page_slug)))?'main-current':'' }}"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a>
<div id="messages-menu-div" class="sub-menu">
@if($gen_class::check_privilege("manage_general_inbox") == 1)
<a href="{{ $gen_class::$admin }}/general-inbox" class="{{ $gen_class::current_page('general-inbox', $page_slug) }}"><i class="fa fa-inbox" aria-hidden="true"></i> General Inbox</a>
@endif @if($gen_class::check_privilege("send_emails") == 1)
<a href="{{ $gen_class::$admin }}/new-message" class="{{ $gen_class::current_page('new-message', $page_slug) }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> New Message</a>
@endif
</div>
@endif

<a id="settings-menu" class="main-menu {{ (!empty($gen_class::current_page('profile', $page_slug)) || !empty($gen_class::current_page('reset-password', $page_slug)))?'main-current':'' }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
<div id="settings-menu-div" class="sub-menu">
<a href="{{ $gen_class::$admin }}/profile" class="{{ $gen_class::current_page('profile', $page_slug) }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
<a href="{{ $gen_class::$admin }}/reset-password" class="{{ $gen_class::current_page('reset-password', $page_slug) }}"><i class="fa fa-lock" aria-hidden="true"></i> Reset Password</a>
</div>

<a class="main-menu" onClick="javascript:my_confirm('Logout Confirmation','Are you sure you want to log out?','/logout');"><i class="fa fa-sign-out"></i> Log Out</a>
</div>

<div class="portal-body portal-content">
<div class="{{ (basename($_SERVER["PHP_SELF"],'.php') == 'index')?'portal-body-wrapper':'body-content form-div' }}">
<x-message/>

{{$slot}}

<x-portal-footer />