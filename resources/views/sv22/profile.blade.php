<x-admin-header :title="$title" :page_slug="$page_slug"> 

@if(!empty($view))

<div class="page-title">My Profile</div>

@if($profile)
@php
$get_id = $profile->id;
$gender = $profile->gender;
$dob = ($profile->dob != "0000-00-00")?$gen_class::sub_date($profile->dob):"";
$address = $profile->address;
$country = $profile->country;
$country_name = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"country"):"";
$country_code = (!empty($country))?$gen_class::in_table("countries_codes",[['id', '=', $country]],"code"):"";
$address .= (!empty($address) && !empty($country_name))?", {$country_name}":"";
$phone = $profile->phone;
$date_registered = ($profile->date_registered != "0000-00-00 00:00:00")?$gen_class::full_date($profile->date_registered):"";
$registered_by_id = $profile->registered_by;
$registered_by_name = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"name"):"";
$registered_by_email = ($registered_by_id > 0)?$gen_class::in_table("users",[['id', '=', $registered_by_id]],"email"):"";
$registered_by = ($registered_by_id > 0)?"{$registered_by_name} ({$registered_by_email})":"Self";
$logged_in = ($profile->logged_in == 1)?"Yes":"No";
$active = $profile->active;
$blocked = $profile->blocked;

$is_controller = $profile->controller;
$role_id = $profile->role_id;
$role_assigned = (!empty($role_id))?"<span class=\"btn btn-success\">" . $gen_class::in_table("role_management",[['id', '=', $role_id]],"role") . "</span>":"<span class=\"btn btn-danger\">Not Assigned</span>";
$role_assigned = (!empty($is_controller))?"<span class=\"btn btn-primary\">SUPER ADMIN</span>":$role_assigned;

$status = "";
if($blocked == 1){
$status = "Blocked";
}else if($active == 1){
$status = "Active";
}else if($active == 0){
$status = "Not active";
}
$date_time = ($profile->date_time != "0000-00-00 00:00:00")?$gen_class::full_date($profile->date_time):"Never logged in";
$last_login = ($profile->last_login != "0000-00-00 00:00:00")?$gen_class::full_date($profile->last_login):"Not Available";
@endphp

<style>
<!--
div table thead tr th, div table tr th, div table tbody tr td, div table tr td{
text-align:left !important;
}
-->
</style>
<div class="overflow">
<table class="table table-striped table-hover">

<tr><td style="width:165px;" class="gen-title">
@php $file_name = $gen_class::det_image('users/' . auth()->user()->id . 'pic*.*', 0); @endphp
<img src="{{asset($file_name)}}" >
</td><td>
<div class="col-sm-6">
<form action="{{ $gen_class::$admin }}/profile/pics" class="img-form" method="post" runat="server" autocomplete="off" enctype="multipart/form-data"> 
@csrf 
<p><b>Format: </b></p>
<p>.jpg, .gif, .png, .jpeg, Not more than 5MB<br /><br /></p>
<input type="file" name="ufile" id="ufile" required>
<label for="ufile" id="pic-label" class="btn gen-btn" ><i class="fa fa-upload" aria-hidden="true"></i> Change picture</label>
@error('ufile')
<p class="required">{{$message}}</p>
@enderror
</form>
</div>
<div class="col-sm-6">
<p><b>User ID:</b> {{$get_id}}</p>
<p><b>Full Name:</b> {{auth()->user()->name}}</p>
<p><b>Email:</b> {{auth()->user()->email}}</p>
<p><b>Status:</b> {{$status}}</p>
<p><b>Last Login:</b> {{$last_login}}</p>
</div>
</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Role Assigned</td><td>{!!$role_assigned!!}</td></tr>
<tr><td class="gen-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</td><td>{{$address}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-code" aria-hidden="true"></i> Country Code</td><td>{{$country_code}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-phone" aria-hidden="true"></i> Telephone</td><td>{{$phone}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Gender</td><td>{{$gender}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Date of Birth</td><td>{{$dob}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Date Registered</td><td>{{$date_registered}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-user" aria-hidden="true"></i> Registered by</td><td>{{$registered_by}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-sign-in" aria-hidden="true"></i> Logged In</td><td>{{$logged_in}}</td></tr>
<tr><td class="gen-title"><i class="fa fa-calendar" aria-hidden="true"></i> Current Login</td><td>{{$date_time}}</td></tr>
</table>
</div>
<div class="bottom-edit"><a href="{{ $gen_class::$admin }}/profile/{{$get_id}}/edit" class="btn gen-btn float-right">Edit Profile</a></div>
@endif

@endif

@if(!empty($edit))

@if($profile->count() == 1)

<div class="back"><a href="{{ $gen_class::$admin }}/profile" class="btn gen-btn"><i class="fa fa-arrow-left"></i> Back to profile</a></div>

<form action="{{ $gen_class::$admin }}/profile/{{$profile->id}}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data" style="overflow-x:auto;">  
<div class="gen-title">Edit Your Profile</div>    

@csrf
@method('PUT')

<div class="col-sm-6">
<label for="name">Full Name <span class="required">(separated with space and surname first) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="name" id="name" class="form-control" placeholder="Type your full name here" value="{{$gen_class::check_inputted('name', $profile->name)}}" required>
</div>
</div>

<div class="col-sm-6">
<label for="phone">Phone No. <span class="required">(with country code, e.g. +2348088811560) *</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
<input type="text" name="phone" id="phone" class="form-control only-no" placeholder="Type your phone no." value="{{$gen_class::check_inputted('phone', $profile->phone)}}" required>
</div>
</div>

<div class="col-sm-6">
<label for="gender">Gender<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<select name="gender" id="gender" title="Select an option" class="form-control js-example-basic-single" required>
<option value="">**Select your gender**</option>
<option value="Male" {{$gen_class::check_selected('gender', 'Male', $profile->gender)}}>Male</option>
<option value="Female" {{$gen_class::check_selected('gender', 'Female', $profile->gender)}}>Female</option>
</select> 
</div>
</div>

<div class="col-sm-6">
<label for="dob">Date of Birth<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
<input type="text" name="dob" id="dob" class="form-control gen-date" onfocus="javascript: $(this).blur();" placeholder="YYYY-MM-DD" value="{{$gen_class::check_inputted('dob', $profile->dob)}}" required>
</div>
</div>
     
<div class="col-sm-12">
<label for="address">Residential Address<span class="required">(street no. and name, region/local gov't, state) *</span></label>
<div class="form-group input-group"> 
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<textarea type="text" name="address" id="address" class="form-control" rows="2" placeholder="Type your full address" required>{{$gen_class::check_inputted('address', $profile->address)}}</textarea>
</div>
</div>

<div class="col-sm-6">
<label for="country">Country<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
<select name="country" id="country" title="Select a country" class="form-control js-example-basic-single" required>
<option value="">**Select a country**</option>
@php($result = \DB::table("countries_codes")->orderBy('country', 'ASC')->get())
@if($result->count() > 0)
@foreach($result  as $result)
<option value="{{$result->id}}" {{$gen_class::check_selected('country', $result->id, $profile->country)}}>{{$result->country}}</option>
@endforeach
@endif
</select> 
</div>
</div>
                   
<div class="submit-div col-sm-6">
<button class="btn gen-btn float-right" name="update"><i class="fa fa-upload"></i> Update</button>
</div>
</form>

@endif
@endif

<script src="{{ asset('js/general-form.js') }}"></script>

</div>
</div>

</div>

</x-admin-header> 