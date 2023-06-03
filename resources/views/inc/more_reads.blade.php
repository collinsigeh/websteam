<h4 class="extra-post-content-heading">More Reads</h4>
<div class="row">
    @foreach ($more_reads as $post)
    <div class="col-lg-3 col-md-6">
        <div class="block-post">
            @if ($post->featured_image)
                <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
            @endif
            <a href="{{ route('posts.view', $post->slug) }}">
                <h6>{{ $post->title }}</h6>
            </a>
        </div>
    </div>
    @endforeach
</div>