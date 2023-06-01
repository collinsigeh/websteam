@if(isset($post))
        <link rel="canonical" href="{{ config('app.url').'/'.$post->slug }}">
        
        <meta property="og:url"           content="{{ config('app.url').'/'.$post->slug }}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="{{ $post->title }}" />
        <meta property="og:image"         content="{{ $post->featured_image }}" />
@endif