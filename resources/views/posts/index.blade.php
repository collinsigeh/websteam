@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">All Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">All Posts</li>
    </ol>
    <div class="mb-4"> 
        <div class="mb-3 py-1" style="background-color: #f0f0f0;">
            <form class="form-inline m-3">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="ItemSearch" />
                    <button class="btn btn-appprimary" id="ItemSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>

        @include('inc.alert_messages')

        <div class="data-card">
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="2">Post</th>
                            <th class="text-center"><span class="d-none d-sm-inline-block">Published</span></th>
                            <th class="text-center d-none d-md-table-cell">Views</th>
                            <th class="text-center d-none d-lg-table-cell">Created</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td width="50" class="d-none d-sm-table-cell">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <img src="{{ $post->featured_image }}" alt="" class="table-featured-img">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-sm-inline-block">
                                    <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                                        @if ($post->is_published)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-xmark text-secondary"></i>
                                        @endif
                                    </a>
                                </span>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                                    {{ $post->views }}
                                </a>
                            </td>
                            <td class="text-center d-none d-lg-table-cell">
                                <a href="{{ route('posts.show', $post->id) }}" class="app-table-link">
                                    {{ date('d M, Y', strtotime($post->created_at)) }}
                                </a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-appprimary" href="{{ route('posts.show', $post->id) }}" title="View"><i class="fas fa-arrow-up-right-from-square"></i></a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-primary" href="{{ route('posts.edit', $post->id) }}" title="Edit"><i class="fas fa-pencil"></i></a>
                            </td>
                            <td width="40">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}" title="Delete"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>

@foreach ($posts as $post)
@include('inc.confirm_post_delete')
@endforeach

@endsection
