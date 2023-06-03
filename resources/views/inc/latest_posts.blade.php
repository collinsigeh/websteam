
<h4 class="extra-post-content-heading">Latest Posts</h4>
@foreach ($latest_posts as $latest_post)
    <h6 class="px-3 py-2 popular-post"><a href="{{ route('posts.view', $latest_post->slug) }}">{{ $latest_post->title }}</a></h6>
@endforeach