
<h4 class="extra-post-content-heading">Popular Posts</h4>
@foreach ($popular_posts as $popular_post)
    <h6 class="px-3 py-2 popular-post"><a href="{{ route('posts.view', $popular_post->slug)}}">{{ $popular_post->title }}</a></h6>
@endforeach