@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $banner->title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('banners.index') }}">All Banner Ads</a></li>
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('banners.show', $banner->id) }}">{{ substr($banner->title, 0, 25).'...' }}</a></li>
        <li class="breadcrumb-item active">Edit Banner Ad</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <form action="{{ route('banners.update', $banner->id) }}" method="post" enctype="multipart/form-data" class="form-card">
            @csrf
            @method('PATCH')
        
            @include('inc.banner_form', [
                'purpose' => 'Edit'
            ])
        </form>
    </div>
</div>
@endsection