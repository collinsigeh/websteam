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
                <div class="mb-4">
                    @include('inc.social_share_buttons')
                </div>
            </div>
        </div>
        @include('inc.within_page_ad')
        @include('inc.more_reads')
    </div>
    <div class="col-lg-4 col-xl-3">
        @include('inc.latest_posts')
        <div class="my-4">
            @include('inc.sidebar_ad')
        </div>
        @include('inc.popular_posts')
    </div>
</div>

@endsection