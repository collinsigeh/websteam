@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $banner->title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('banners.index') }}">All Banner Ads</a></li>
        <li class="breadcrumb-item active">{{ substr($banner->title, 0, 35).'...' }}</li>
    </ol>

    @include('inc.alert_messages')
    
    <div class="mb-4"> 
        <div class="data-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 post-info bg-appgrey">
                        <h6 class="post-info-title">Total Impressions:</h6>
                        <div class="post-total-views">{{ $banner->impressions }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 post-info bg-appgrey">
                        <h6 class="post-info-title">Total Clicks:</h6>
                        <div class="post-total-views">{{ $banner->clicks }}</div>
                    </div>
                </div>
            </div>
            <div class="mb-3 py-1 bg-appgrey">
                <div class="post-info">
                    <h6 class="post-info-title">Redirect URL:</h6>
                    <div class="post-info-body post-url">{{ $banner->redirect_url }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <div class="mb-3 post-info bg-appgrey">
                        <h6 class="post-info-title">Banner Ad Setting:</h6>
                        <div class="post-publication-settings">
                            <form action="{{ route('banners.quickupdate', $banner->id) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <div class="post-publication-status">
                                    <div class="mb-3">
                                        <label for="publication_status" class="col-form-label"><small>Display Status:</small></label>
                                        <select class="form-select form-select-sm" aria-label="Post visibility options" id="publication_status" name="display_status" required>
                                            <option value="{{ $banner->is_active }}" selected>
                                                @if ($banner->is_active == 1)
                                                    Active
                                                @else
                                                    NOT Active
                                                @endif
                                            </option>
                                            <option value=""></option>
                                            @if ($banner->is_active == 1)
                                                <option value="0">Disable</option>
                                            @else
                                                <option value="1">Enable</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="post-primary-category">
                                    <div class="mb-1">
                                        <label for="start_display_at" class="col-form-label"><small>Start Display At:</small></label>
                                        <input type="datetime-local" class="form-control form-control-sm" id="start_display_at" name="start_display_at" value="{{ $banner->start_display_at }}" required>
                    
                                        @error('start_display_at')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="post-visibility">
                                    <div class="mb-3">
                                        <label for="stop_display_at" class="col-form-label"><small>Stop Display At:</small></label>
                                        <input type="datetime-local" class="form-control form-control-sm" id="stop_display_at" name="stop_display_at" value="{{ $banner->stop_display_at }}" required>
                    
                                        @error('stop_display_at')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    <input type="submit" value="Save Changes" class="btn btn-sm btn-outline-appprimary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-lg-8">
                    <div class="post-content">
                        <h3>{{ $banner->title }}</h3>
                        <div class="row">
                            <div class="col-xl-6">
                                <img src="{{ $banner->featured_image }}" alt="">
                            </div>
                            <div class="col-xl-6">
                                <div class="categories">
                                    <h6>Display Positions:</h6>
                                    <p>
                                        @if ($banner->is_display_above_page)
                                            <span class="btn btn-sm btn-outline-secondary my-1">Above page</span>
                                        @endif
                                        @if ($banner->is_display_on_sidebar)
                                            <span class="btn btn-sm btn-outline-secondary my-1">In sidebar</span>
                                        @endif
                                        @if ($banner->is_display_within_page)
                                            <span class="btn btn-sm btn-outline-secondary my-1">Within page</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="categories">
                                    <h6>Display On:</h6>
                                    <p>
                                        @if ($banner->is_display_on_homepage)
                                            <span class="btn btn-sm btn-outline-secondary my-1">Home page</span>
                                        @endif
                                        @if ($banner->is_display_on_allsegments)
                                            <span class="btn btn-sm btn-outline-secondary my-1">All sub-pages</span>
                                        @else
                                            <span class="btn btn-sm btn-outline-secondary my-1">Selected sub-pages</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            @if (strlen($banner->additional_information) > 1)
                                <h6>Additional Information:</h6>
                                {!! $banner->additional_information !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @include('inc.banner_edit_delete_details')
        </div>
    </div>
</div>

@include('inc.confirm_banner_delete')
@endsection
