<x-admin-header :title="$title" :page_slug="$page_slug"> 

<style>
<!--
.body-content2{
background:#ddd;
padding:10px;
}
.portal-body-wrapper{
width:100%;
margin-bottom:20px;
}
.portal-body .home-nav{
width:25%;
float:left;
padding:10px;
}
.portal-body .home-nav a{
text-decoration:none !important;
}

@media(max-width:1200px){
.portal-body .home-nav{
width:50%;
}
}
@media(max-width:900px){
.portal-body .home-nav{
width:100%;
}
}
@media(max-width:800px){
.portal-body .home-nav{
width:50%;
}
}
@media(max-width:500px){
.portal-body .home-nav{
width:100%;
}
}

.shadow{
-webkit-box-shadow: -1px 0px 13px 0px rgba(0,0,0,0.48);
-moz-box-shadow: -1px 0px 13px 0px rgba(0,0,0,0.48);
box-shadow: -1px 0px 13px 0px rgba(0,0,0,0.48);
}

.details{
margin:10px;
}
.details p{
font-size:30px;
overflow:hidden;
padding:10px;
}
.portal-body .body-content2{
display:table;
width:100%;
}
.portal-body .body-content2 div.inner-content{
display:table-cell;
}
.portal-body .body-content2 div.icon-div{
width:50px;
padding-left:5px;
text-align:right;
vertical-align:bottom;
}
.portal-body .body-content2 div.icon-div i{
font-size:70px;
}
.portal-body .body-content2:hover{
background:#000;
color:#fff;
}
.portal-body .body-content2:hover *{
color:#fff;
}
.red{
color:#f33;
}
.green{
color:#5cb85c;
}
.purple{
color:#966;
}

-->
</style>

<div class="page-title">Admin Dashboard</div>

@if($gen_class::check_privilege("manage_admin_users") == 1)

<div class="home-nav">
<a href="{{ $gen_class::$admin }}/manage-admin"><div class="body-content2 shadow">
<div class="inner-content">
<p>Admin Users: <b><?php //echo formatQty(in_table("COUNT(id) AS Total",$users_tb,"WHERE admin = '1'","Total")); ?></b></p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#5cb85c;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-users red" aria-hidden="true"></i>
</div>
</div></a>
</div>

@endif @if($gen_class::check_privilege("manage_general_inbox") == 1)

<div class="home-nav">
<a href="{{ $gen_class::$admin }}/general-inbox"><div class="body-content2 shadow">
<div class="inner-content">
<p>Inbox: <b><?php //echo formatQty(in_table("COUNT(id) AS Total","admin_messages","WHERE recipient_email = '$gen_email' AND inbox = '1'","Total")); ?></b></p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#5cb85c;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-inbox" aria-hidden="true"></i>
</div>
</div></a>
</div>

@endif

<div class="home-nav">
<a href="{{ $gen_class::$admin }}/profile"><div class="body-content2 shadow">
<div class="inner-content">
<p>Profile</p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#5bc0de;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-user purple" aria-hidden="true"></i>
</div>
</div></a>
</div>

<div class="home-nav">
<a href="{{ $gen_class::$admin }}/reset-password"><div class="body-content2 shadow">
<div class="inner-content">
<p>Change Password</p>
<div style="background:#ddd;"><div style="width:70%; padding:7px; background:#f33;"></div></div>
</div>
<div class="inner-content icon-div">
<i class="fa fa-lock green" aria-hidden="true"></i>
</div>
</div></a>
</div>

</div>


</div>

</div>

</x-user-header> 