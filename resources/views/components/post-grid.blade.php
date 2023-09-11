@props(['file_name', 'post'])

<div class="item-inner">
<div class="white-bg shadow border-radius" style="padding:0px;">
<div class="item-picture-bg" style="background:url({{ asset($file_name) }}) no-repeat left top; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin-bottom: 10px;"></div>
<div class="item-title">{{ $post->title }}</div>
<div style="margin-bottom:5px;"><a href="project-photo-details/{{ $post->title_slug }}" class="btn gen-btn item-quote border-radius">View details</a></div>
</div>
</div>