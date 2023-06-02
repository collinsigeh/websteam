@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">New Banner Ad</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('posts.index') }}">All Banners Ads</a></li>
        <li class="breadcrumb-item active">New Banner Ad</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data" class="form-card">
            @csrf
            
            @include('inc.banner_form', [
                'purpose' => 'Create'
            ])
        </form>
    </div>
</div>
@endsection
