@extends('layouts.web')

@section('content')

<h2 id="segment-title">
    {{ $segment->category_name }}
</h2>

<div class="row">
    <div class="col-lg-8 col-xl-9">
        @php
            $displayed = 0;
        @endphp
        @foreach ($segment_posts as $post)
            <div id="segment-post-view" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('posts.view', $post->slug)}}">
                            <img id="featured-image" src="{{ $post->featured_image }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="py-md-3">
                            <a href="{{ route('posts.view', $post->slug)}}">
                                <h5 id="title" class="mb-3">{{ $post->title }}</h5>
                            </a>
                            <div id="body">
                                @include('inc.post_tags')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $displayed = $displayed + 1;
            @endphp
            @if ($displayed == 4)
                @include('inc.within_page_ad')
            @endif
        @endforeach
        <div class="mt-3">
            {!! $segment_posts->links() !!}
        </div>
    </div>
    <div class="col-lg-4 col-xl-3">
        @include('inc.social_icons')
        @include('inc.latest_posts')
        <div class="my-4">
            @include('inc.sidebar_ad')
        </div>
        @include('inc.popular_posts')
    </div>
</div>

@endsection