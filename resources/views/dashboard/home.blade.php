@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div id="dashboard-line"></div>
    @include('inc.alert_messages')
    <div class="dashboard-section">
        <div class="dashboard-card-title">
            <h5>Post & Banner Ad Performance:</h5>
        </div>
        <div class="dashboard-data-card">
            <div class="row">
                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>POST VIEWS</h6>
                        <div class="dashboard-card-main-item">{{ $post_views }}</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>BANNER AD IMPRESSIONS</h6>
                        <div class="dashboard-card-main-item">{{ $ad_impressions }}</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>BANNER AD CLICKS</h6>
                        <div class="dashboard-card-main-item">{{ $ad_clicks }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="dashboard-section">
                <div class="dashboard-card-title">
                    <h5>Latest Posts:</h5>
                </div>
                <div class="dashboard-data-card">
                    @include('inc.posts_table', [
                        'display' => 'Dashboard',
                        'posts' => $latest_posts
                    ])
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="dashboard-section">
                <div class="dashboard-card-title">
                    <h5>Popular Posts:</h5>
                </div>
                <div class="dashboard-data-card">
                    @include('inc.posts_table', [
                        'display' => 'Dashboard',
                        'posts' => $popular_posts
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($latest_posts as $post)
@include('inc.confirm_post_delete')
@endforeach

@foreach ($popular_posts as $post)
@include('inc.confirm_post_delete')
@endforeach

@endsection
