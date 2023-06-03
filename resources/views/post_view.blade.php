@extends('layouts.web')

@section('content')

<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div id="post-view">
            <h2 id="title">{{ $post->title }}</h2>
            @include('inc.social_share_buttons')
            <img id="featured-image" src="{{ $post->featured_image }}" alt="">
            <div id="body">
                {!! $post->body !!}
                @include('inc.post_tags')
            </div>
        </div>
        @include('inc.within_page_ad')
    </div>
    <div class="col-lg-4 col-xl-3">
        @include('inc.sidebar_ad')

        <h4 class="p-3 bg-appcolor">Latest Posts</h4>
        @foreach ($latest_posts as $latest_post)
            <h6 class="px-3 py-2 popular-post"><a href="{{ route('posts.view', $latest_post->slug) }}">{{ $latest_post->title }}</a></h6>
        @endforeach
    </div>
</div>

@endsection