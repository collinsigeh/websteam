@extends('layouts.web')

@section('content')

<div class="row">
    <div class="col-lg-8 col-xl-9">
        @if ($posts->count() > 0)
            <div id="latest-post">
                @if ($posts[0]->featured_image) 
                    <a href="{{ route('posts.view', $posts[0]->slug) }}"><img src="{{ $posts[0]->featured_image}}" alt=""></a>
                @endif
                <a href="{{ route('posts.view', $posts[0]->slug) }}"><h2>{{ $posts[0]->title }}</h2></a>
                <div style="padding: 0 15px 15px 15px; margin-top: -15px; color: #666666; font-size: 14px;">
                    @if ($posts[0]->created_at == $posts[0]->updated_at)
                      {{ $posts[0]->updated_at->diffForHumans() }}
                    @else
                      updated {{ $posts[0]->updated_at->diffForHumans() }}
                    @endif
                </div>
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
                            <div class="card-post-content">
                                @if ($post->featured_image)
                                    <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
                                @endif
                                <a href="{{ route('posts.view', $post->slug) }}"><h6>{{ $post->title }}</h6></a>
                            </div>
                            @include('inc.card_post_date')
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        @endif

        @include('inc.within_page_ad')

        @foreach ($post_blocks as $segment)
        @if (count($segment['posts']) > 0)
        <div class="segment-block">
            <div class="title"><span class="segment-title">{{ $segment['title'] }}</span></div>
            <div class="row">
                @foreach ($segment['posts'] as $post)
                    <div class="col-lg-3 col-md-6">
                        <div class="block-post">
                            <div class="card-post-content">
                                @if ($post->featured_image)
                                    <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
                                @endif
                                <a href="{{ route('posts.view', $post->slug) }}">
                                    <h6>{{ $post->title }}</h6>
                                </a>
                            </div>
                            @include('inc.card_post_date')
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="col-lg-4 col-xl-3">
        @include('inc.social_icons')
        <div class="my-4">
            @include('inc.sidebar_ad')
        </div>
        @include('inc.popular_posts')
        @include('inc.report_segments')
    </div>
</div>

@endsection