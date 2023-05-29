@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $category->category_name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('categories.index') }}">All Categories</a></li>
        <li class="breadcrumb-item active">{{ $category->category_name }}</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <div class="data-card">
            
        </div>
    </div>
</div>
@endsection
