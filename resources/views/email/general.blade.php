@php
use App\Http\Controllers\GenClass;
@endphp

<html>
<head>
<title>{{$title}}</title>
</head>
<body>

<div style="background:#f9f9f9 !important; padding:10px !important; font-family:Arial, Helvetica, sans-serif; font-size:16px !important;">
<div style="margin:auto !important; width:100% !important; max-width:800px !important;">

<div style="padding:10px !important; padding-top:30px !important;">
<img src="{{ asset('images/logos/samvick-logo.png') }}">
</div>

<div style="min-height:300px !important; padding:10px !important; background:#fff !important;">
{!! $body . $regards !!}
</div>

<p style="font-size:14px !important;">
<span style="font-weight:bold !important;">Email:</span> {{GenClass::$gen_email}},<br>
<span style="font-weight:bold !important;">Phone:</span> {{GenClass::$gen_phone}},<br>
<span style="font-weight:bold !important;">Website:</span> <a href="{{ url('/') }}" style="color:#f33 !important; text-decoration:none !important;">{{url("/")}}</a>.
</p>
{!! !empty($foot_note)?"<p style=\'background:#ddd !important;font-size:12px !important; padding:10px !important; overflow:hidden !important;\">{$foot_note}</p>":"" !!}
</div>
</div>

</body>
</html>