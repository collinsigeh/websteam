@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $post->title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('posts.index') }}">All Posts</a></li>
        <li class="breadcrumb-item active">{{ substr($post->title, 0, 35).'...' }}</li>
    </ol>

    @include('inc.alert_messages')
    
    <div class="mb-4"> 
        <div class="data-card">
            <div class="mb-3 py-1 bg-appgrey">
                <div class="post-info">
                    <h6 class="post-info-title">URL:</h6>
                    <div class="post-info-body post-url">{{ config('app.url').'/'.$post->slug }}</div>
                    @include('inc.social_share_buttons')
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="mb-3 post-info bg-appgrey">
                        <h6 class="post-info-title">Total Views:</h6>
                        <div class="post-total-views">{{ $post->views }}</div>
                    </div>
                    <div class="mb-3 post-info bg-appgrey">
                        <h6 class="post-info-title">Publication Settings:</h6>
                        <div class="post-publication-settings">
                            <form action="{{ route('posts.quickupdate', $post->id) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <div class="post-primary-category">
                                    <div class="mb-1">
                                        <label for="primary_category" class="col-form-label"><small>Primary Category:</small></label>
                                        <select class="form-select form-select-sm" aria-label="Primary category" id="primary_category" name="primary_category" required>
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if (isset($post) && $post->primary_category_id == $category->id) selected @else @if (old('primary_category') == $category->id) selected @endif @endif>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="post-visibility">
                                    <div class="mb-1">
                                        <label for="visibility" class="col-form-label"><small>Visibility:</small></label>
                                        <select class="form-select form-select-sm" aria-label="Post visibility options" id="visibility" name="visibility" required>
                                            <option value="public" @if (isset($post) && $post->visibility == 'public') selected @else @if (old('visibility') == 'public') selected @endif @endif>Public (all visitors)</option>
                                            <option value="paid_subscribers" @if (isset($post) && $post->visibility == 'paid_subscribers') selected @else @if (old('visibility') == 'paid_subscribers') selected @endif @endif>Paid subscribers</option>
                                            <option value="private" @if (isset($post) && $post->visibility == 'private') selected @else @if (old('visibility') == 'private') selected @endif @endif>Private (admins, editors, and the author only)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="post-publication-status">
                                    <div class="mb-3">
                                        <label for="publication_status" class="col-form-label"><small>Publication Status:</small></label>
                                        <select class="form-select form-select-sm" aria-label="Post visibility options" id="publication_status" name="publication_status" required>
                                            <option value="{{ $post->is_published }}" selected>
                                                @if ($post->is_published == 1)
                                                    Published
                                                @else
                                                    NOT Published
                                                @endif
                                            </option>
                                            <option value=""></option>
                                            @if ($post->is_published == 1)
                                                <option value="0">Unpublish</option>
                                            @else
                                                <option value="1">Publish</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <input type="submit" value="Save Changes" class="btn btn-sm btn-outline-appprimary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    @include('inc.post_edit_delete_content')

                    <div class="post-content">
                        <h3>{{ $post->title }}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ $post->featured_image }}" alt="">
                            </div>
                        </div>
                        <div class="body">
                            {!! $post->body !!}
                        </div>
                        @include('inc.post_tags')
                        @if ($post->categories->count() > 0)
                        <div class="categories">
                            <h6>REPORT SEGMENTS:</h6>
                            <p>
                                @foreach ($post->categories as $segment)
                                    <span class="btn btn-sm btn-outline-secondary">{{ $segment->category_name }}</span>
                                @endforeach
                            </p>
                        </div>
                        @endif
                    </div>

                    @include('inc.post_edit_delete_content')
                </div>
            </div>
        </div>
    </div>
</div>

@include('inc.confirm_post_delete')
@endsection
