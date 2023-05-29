@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">All Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">All Categories</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <div class="data-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th class="text-center d-none d-sm-table-cell">No. of Posts</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="app-table-link">
                                    {{ $category->category_name }}
                                </a>
                            </td>
                            <td class="text-center d-none d-sm-table-cell">
                                <a href="{{ route('categories.show', $category->id) }}" class="app-table-link">
                                    {{ $category->posts->count() }}
                                </a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-appprimary" href="{{ route('categories.show', $category->id) }}" title="View"><i class="fas fa-arrow-up-right-from-square"></i></a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-primary" href="{{ route('categories.edit', $category->id) }}" title="Edit"><i class="fas fa-pencil"></i></a>
                            </td>
                            <td width="40">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $category->id }}" title="Delete"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
</div>

@foreach ($categories as $category)
@include('inc.confirm_category_delete')
@endforeach

@endsection
