<x-admin-header :title="$title" :page_slug="$page_slug"> 

@if(isset($default))

@php $pn = (isset($gen_class::$pn))?$gen_class::$pn:1; @endphp

<div class="page-title">Newsletter Subscribers ({{$display_few->count()}})</div>

<form action="{{ $gen_class::$admin }}/newsletter-subscribers" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="search" value="1" />
<div class="search-dates">
@csrf
@php $prefix = "newsletter-subscribers-" @endphp

<div class="col-md-6">
<label for="keyword">Keyword</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Name or Email" value="{{ session($prefix.'keyword') }}">
</div>
</div>

<div class="col-md-4">
<label for="no_of_rows">No. of Rows</label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
<input type="number" name="no_of_rows" id="no_of_rows" class="form-control only-no" placeholder="No. of rows" value="{{ $gen_class::$per_view }}">
</div>
</div>

<div class="col-md-2">
<br />
<button type="submit" class="btn gen-btn float-right"><i class="fa fa-search"></i> Search</button>
</div>

</div>
</form>

@if($gen_class::$count > 0)

<div class="overflow">
<table class="table table-striped table-hover">
<thead>
<tr class="gen-title">
<th>S/N</th>
<th>Name</th>
<th>Email</th>
<th>Date Subscribed</th>
</tr>
</thead>
<tbody>

@foreach($display_few as $post)
@php
$get_id = $post->id;
$name = $post->name;
$email = $post->email;
$date_time = ($post->date_time != "0000-00-00 00:00:00")?$gen_class::min_full_date($post->date_time):"";
@endphp
<tr>
<td>{{$get_id}}</td>
<td>{{$name}}</td>
<td>{{$email}}</td>
<td>{{$date_time}}</td>
</tr>
@endforeach

</tbody>
</table>
</div>

{!! ($gen_class::$last_page>1)?"<div class=\"page-nos\">" . $gen_class::$center_pages . "</div>":"" !!}

@else
<div class="not-success">No subscribers found.</div>
@endif

@endif

<script src="{{ asset('js/general-form.js') }}"></script>

</div>
</div>

</div>

</x-admin-header> 