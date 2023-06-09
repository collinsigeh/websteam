<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="col-form-label">Banner Ad Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Title of new banner ad" name="title"  value="@if ($purpose == 'Edit' && isset($banner)) {{ $banner->title }} @else {{ old('title') }} @endif" autocomplete="title" required>
                                                            
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="redirect_url" class="col-form-label">Redirect URL: <br><small>HINT: enter <strong>#</strong> if no redirect url otherwise enter the https://... web address</small></label>
            <input type="text" class="form-control" id="redirect_url" placeholder="Web address to redirect to" name="redirect_url"  value="@if ($purpose == 'Edit' && isset($banner)) {{ $banner->redirect_url }} @else {{ old('redirect_url') }} @endif" autocomplete="redirect_url" required>
                                                            
            @error('redirect_url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        @if ($purpose == 'Edit')
        <div class="mb-3">
            <label for="publication_status" class="col-form-label">Display Status:</label>
            <select class="form-select" aria-label="Banner display status options" id="publication_status" name="display_status" required>
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
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="start_display_at" class="col-form-label">Start Display At:</label>
                    <input type="datetime-local" class="form-control" id="start_display_at" name="start_display_at" min="{{ $min_time }}" value="{{ $min_time }}">

                    @error('start_display_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="stop_display_at" class="col-form-label">Stop Display At:</label>
                    <input type="datetime-local" class="form-control" id="stop_display_at" name="stop_display_at" min="{{ $min_stop_time }}" value="{{ $min_stop_time }}">

                    @error('stop_display_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="display_positions">Display Positions:</label>
                </div>
        
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="display_above_page" name="display_above_page" value="1"  @if (isset($banner) && !$banner->is_display_above_page) notchecked @else checked @endif>
                        <label class="form-check-label" for="dispalay_above_page">Display above page</label>
                    </div>
                </div>
        
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="display_in_sidebar" name="display_in_sidebar" value="1"  @if (isset($banner) && !$banner->is_display_in_sidebar) notchecked @else checked @endif>
                        <label class="form-check-label" for="dispalay_in_sidebar">Display in sidebar</label>
                    </div>
                </div>
        
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="display_within_page" name="display_within_page" value="1"  @if (isset($banner) && !$banner->is_display_within_page) notchecked @else checked @endif>
                        <label class="form-check-label" for="dispalay_within_page">Display within page</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="display_pages">Display Pages:</label>
                </div>
        
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="display_on_homepage" name="display_on_homepage" value="1"  @if (isset($banner) && !$banner->is_display_on_homepage) notchecked @else checked @endif>
                        <label class="form-check-label" for="dispalay_on_homepage">Display on homepage</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="display_on_allsegments" onchange="displaySegmentOption(event)" name="display_on_allsegments" value="1"   @if (isset($banner) && $banner->is_display_on_allsegments != 1) notchecked @else checked @endif>
                        <label class="form-check-label" for="display_on_allsegments">Display on all segments</label>
                    </div>
                </div>

                <div class="mb-3" id="display_segments_box" style="@if (isset($banner) && $banner->is_display_on_allsegments != 1) display: block;  @endif">
                    <label for="all-categories" class="col-form-label">Tick Segments to Display Banner <small>(Optional)</small>:</label>
                    @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ $category->id }}" name="categories[{{ $category->id }}]"
                        @php
                            if ($purpose == 'Edit' && isset($banner))
                            {
                                $category_found = 0;
                                foreach ($banner->categories as $this_category) {
                                    if ($this_category->id == $category->id) {
                                        $category_found++;
                                    }
                                }
                                if ($category_found > 0) {
                                    echo 'checked';
                                }
                            }
                        @endphp
                        >
                        <label class="form-check-label" for="{{ $category->id }}">
                            {{ $category->category_name }}
                        </label>
                    </div>
                    @endforeach
                    <small><a class="btn btn-sm btn-link" style="text-decoration: none;" href="{{ route('categories.create') }}">+ New display segment</a></small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <div>
                <label class="col-form-label">Featured Image <small>(Optional)</small>:</label><br>
                <div style="text-align: right; margin-bottom: 8px;"><small> <button class="btn btn-sm btn-outline-secondary" style="font-size: 12px;"  data-bs-toggle="modal" data-bs-target="#staticBackdropBannerHint">View image hint</button></small></div>
            </div>
            <div id="preview">@if (isset($banner) && $banner->featured_image ) <img src="{{ $banner->featured_image }}" alt=""> @else <p>Preview</p> @endif</div>
            <label for="image" class="upload-label" id="upload-label">@if (isset($banner->featured_image) && $banner->featured_image) Change featured image @else Select a file @endif</label>
            <input type="file" accept="image/*" id="image" onchange="getImagePreview(event)" name="featured_image" class="upload-field" value="{{ old('featured_image') }}" @if($purpose != 'Edit') required @endif>
        </div>

        <div class="mb-3">
            <label for="additional_information" class="col-form-label">Additional Information <small>(Optional)</small>:</label>
            <textarea class="form-control" id="additional_information" placeholder="Write any other details here" name="additional_information" autocomplete="additional_information">@if ($purpose == 'Edit' &&  isset($banner)) {{ $banner->additional_information }} @else {{ old('additional_information') }} @endif</textarea>
                                                            
            @error('additional_information')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-5 mt-4 text-center">
    <input type="submit" value="@if ($purpose == 'Edit') Save Changes @else Save @endif" class="btn btn-lg btn-appprimary">
</div>

@include('inc.banner_hint')