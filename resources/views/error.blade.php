@extends('layouts.app')

@section('content')

<style>
<!--
.shadow{
background:#fff;
text-align:center;
padding:20px;
}
fieldset{
max-width:400px;
margin-left:auto;
margin-right:auto;
}
legend, legend *{
font-size:20px;
color:#900;
}
.both-border p{
font-size:18px;
text-align:center;
}
-->
</style>

<div class="container both-border" style="min-height:500px; padding-top:50px;"> 

<fieldset class="border-radius">
<legend><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error</legend>

<p>Hello! We are sorry. Your request is not available.</p>
</fieldset>

</div>

@endsection