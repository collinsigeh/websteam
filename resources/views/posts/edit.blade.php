@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $post->title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('posts.index') }}">All Posts</a></li>
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('posts.show', $post->id) }}">{{ substr($post->title, 0, 25).'...' }}</a></li>
        <li class="breadcrumb-item active">Edit Post</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data" class="form-card">
            @csrf
            @method('PATCH')
        
            @include('inc.post_form', [
                'purpose' => 'Edit'
            ])
        </form>
    </div>
</div>
@endsection