@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">All Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">All Posts</li>
    </ol>
    <div class="mb-4"> 
        <div class="mb-3 py-1 bg-appgrey">
            <form class="form-inline m-3">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="ItemSearch" />
                    <button class="btn btn-appprimary" id="ItemSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        @include('inc.alert_messages')

        <div class="data-card">
            @if ($posts->count() < 1)
            <div class="text-center">
                <div class="alert alert-info">No post to dispay.</div>
                <a href="{{ route('posts.create') }}" class="btn btn-appprimary">Create your first post</a>
            </div>
            @else
            @include('inc.posts_table', [
                'display' => 'Posts Page'
            ])
            <div class="mt-3">
                {!! $posts->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

@foreach ($posts as $post)
@include('inc.confirm_post_delete')
@endforeach

@endsection
