@extends('layouts.web')

@section('content')

<div class="row">
    <div class="col-12">
        @if ($posts->count() > 0)
        <div id="latest-post">
            @if ($posts[0]->featured_image) 
                <a href="{{ route('posts.view', $posts[0]->slug) }}"><img src="{{ $posts[0]->featured_image}}" alt=""></a>
            @endif
            <a href="{{ route('posts.view', $posts[0]->slug) }}"><h2>{{ $posts[0]->title }}</h2></a>
        </div>
        <div id="next-to-latest-posts">
            <div class="row">
            @php
                $count = 0
            @endphp
            @foreach ($posts as $post)
                @php
                    $count++;
                @endphp
                @if ($count > 1)
                <div class="col-lg-4 col-md-6">
                    <div class="next-to-latest post">
                        @if ($post->featured_image)
                            <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
                        @endif
                        <a href="{{ route('posts.view', $post->slug) }}"><h5>{{ $post->title }}</h5></a>
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        </div>
        @endif

        @foreach ($post_blocks as $segment)
        @if (count($segment['posts']) > 0)
        <div class="segment-block">
            <div class="title"><span class="segment-title">{{ $segment['title'] }}</span></div>
            <div class="row">
                @foreach ($segment['posts'] as $post)
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
        </div>
        @endif
        @endforeach
    </div>
</div>

@endsection