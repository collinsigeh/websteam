@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">All Banners</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">All Banners</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <div class="data-card">
            @if ($banners->count() < 1)
            <div class="text-center">
                <div class="alert alert-info">No banner ad to dispay.</div>
                <a href="{{ route('banners.create') }}" class="btn btn-appprimary">Create your first banner ad</a>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="2">Banner Ad</th>
                            <th class="text-center"><span class="d-none d-sm-inline-block">Status</span></th>
                            <th class="text-center d-none d-md-table-cell">Impressions</th>
                            <th class="text-center d-none d-md-table-cell">Clicks</th>
                            <th class="text-center d-none d-lg-table-cell">Created</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td width="50" class="d-none d-sm-table-cell">
                                <a href="{{ route('banners.show', $banner->id) }}">
                                    <img src="{{ $banner->featured_image }}" alt="" class="table-featured-img">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('banners.show', $banner->id) }}" class="app-table-link">
                                    {{ $banner->title }}
                                </a>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-sm-inline-block">
                                    <a href="{{ route('banners.show', $banner->id) }}" class="app-table-link">
                                        @if ($banner->is_active)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-xmark text-secondary"></i>
                                        @endif
                                    </a>
                                </span>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('banners.show', $banner->id) }}" class="app-table-link">
                                    {{ $banner->impressions }}
                                </a>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('banners.show', $banner->id) }}" class="app-table-link">
                                    {{ $banner->clicks }}
                                </a>
                            </td>
                            <td class="text-center d-none d-lg-table-cell">
                                <a href="{{ route('banners.show', $banner->id) }}" class="app-table-link">
                                    {{ date('d M, Y', strtotime($banner->created_at)) }}
                                </a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-appprimary" href="{{ route('banners.show', $banner->id) }}" title="View"><i class="fas fa-arrow-up-right-from-square"></i></a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-primary" href="{{ route('banners.edit', $banner->id) }}" title="Edit"><i class="fas fa-pencil"></i></a>
                            </td>
                            <td width="40">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $banner->id }}" title="Delete"><i class="fa-regular fa-circle-xmark"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {!! $banners->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

@foreach ($banners as $banner)
@include('inc.confirm_banner_delete')
@endforeach

@endsection
