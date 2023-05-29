@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $post->title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('posts.index') }}">All Posts</a></li>
        <li class="breadcrumb-item active">{{ $post->title }}</li>
    </ol>
    <div class="mb-4"> 
        
    </div>
</div>
@endsection
