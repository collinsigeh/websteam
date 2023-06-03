<h4 class="extra-post-content-heading">Report Segments</h4>
@foreach ($segments as $segment)
<h6 class="px-3 py-2 popular-post"><a href="{{ route('segments.view', $segment->slug)}}">{{ $segment->category_name }}</a></h6>
@endforeach