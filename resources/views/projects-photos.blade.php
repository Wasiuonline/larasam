@extends('layouts.app')

@section('content')

<div class="home-body-wrapper"> 
<div class="container">

<h1 class="body-header">SamVick Past <span>Projecs Photos</span></h1>

<div class="search-section">

<div class="category-group-header btn" onclick="javascript:$('.gen-search-form').slideToggle();">
<i class="fa fa-search" aria-hidden="true"></i> Search for Event Photos
</div>

<form action="projects-photos" method="post" class="gen-search-form login-form" runat="server" autocomplete="off">
<input type="hidden" name="search" value="1" />
@csrf
@php $prefix = "projects-photos-" @endphp
<div class="col-md-10">
<label for="keyword">Keyword</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Project title" value="{{ session($prefix.'keyword') }}">
</div>
</div>

<div class="col-md-2" style="padding:0px; padding-right:5px;">
<br />
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-search"></i> Search</button>
</div>

</form>

</div>

<!-- Our Recent Projects -->
@if($gen_class::$count > 0)
<x-post-wrapper>
@foreach($display_few as $post)
@php $file_name =  $gen_class::det_image('items-featured/' . $post->id . '_' . $post->posted_by . '_item_featured_*.*', 0) @endphp
<x-post-grid :file_name="$file_name" :post="$post"/>
@endforeach

@if($gen_class::$last_page>1)
<div class="page-nos">{!! $gen_class::$center_pages !!}</div>
@endif

</x-post-wrapper>
@else
<div class='alert alert-danger alert-dismissable fade in'>No projects available for this search.</div>
@endif
<!-- Ends Our Recent Projects -->

<?php
/*$offset = ($per_view * $pn) - $per_view;

$result = $db->select($table, $where, "*", "ORDER BY id DESC", "LIMIT {$offset},{$per_view}");
if(count_rows($result) > 0){
?>
<div class="item-wrapper">
<?php
while($row = fetch_data($result)){
load_project_photo();
}
?>
</div>
<?php
echo ($last_page>1)?"<div class=\"page-nos\">" . $center_pages . "</div>":"";
}else{
?>
<div class='alert alert-danger alert-dismissable fade in'>No projects available for this search.</div>
<?php
}*/
?>


</div>
</div>

@endsection