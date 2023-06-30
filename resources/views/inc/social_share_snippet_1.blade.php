@if(isset($post))
        <link rel="canonical" href="{{ config('app.url').'/'.$post->slug }}">
        
        <meta property="og:url"           content="{{ config('app.url').'/'.$post->slug }}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="{{ $post->title }}" />
        <meta property="og:image"         content="@if ($post->thumbnail_image)
        {{ $post->thumbnail_image }}
    @else
        {{ $post->featured_image }}
    @endif" />

        <link rel="image_src" href="@if ($post->thumbnail_image)
        {{ $post->thumbnail_image }}
    @else
        {{ $post->featured_image }}
    @endif"> 
@endif