<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="col-form-label">Post Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Title of new post" name="title"  value="@if ($purpose == 'Edit' && isset($post)) {{ $post->title }} @else {{ old('title') }} @endif" autocomplete="title" required>
                                                            
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="editor" class="col-form-label">Post Body:</label>
            <textarea class="form-control" id="editor" placeholder="Main content of new post" name="body" autocomplete="body">@if ($purpose == 'Edit' &&  isset($post)) {{ $post->body }} @else {{ old('body') }} @endif</textarea>
                                                            
            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <div>
                <label class="col-form-label">Featured Image <small>(Optional)</small>: <br><small class="text-muted">HINT - Best images sizes: <br>1200 x 600 <i>-or-</i> 800 x 400 <i>-or-</i> 600 x 300</small></label>
                
            </div>
            <div id="preview">@if (isset($post) && $post->featured_image ) <img src="{{ $post->featured_image }}" alt=""> @else <p>Preview</p> @endif</div>
            <label for="image" class="upload-label" id="upload-label">@if (isset($post->featured_image) && $post->featured_image) Change featured image @else Select a file @endif</label>
            <input type="file" accept="image/*" id="image" onchange="getImagePreview(event)" name="featured_image" class="upload-field" value="{{ old('featured_image') }}">
        </div>

        <div class="mb-3">
            <label for="tags" class="col-form-label">Tags <small>(Optional)</small>:</label>
            <textarea class="form-control" id="tags" placeholder="Comma separated tags" name="tags" autocomplete="tags">@if ($purpose == 'Edit' && isset($post)) {{ $post->tags }} @else {{ old('tags') }} @endif</textarea>
                                                            
            @error('tags')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="all-categories" class="col-form-label">Categories <small>(Optional)</small>:</label>
            @foreach ($categories as $category)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ $category->id }}" name="categories[{{ $category->id }}]"
                @php
                    if ($purpose == 'Edit' && isset($post))
                    {
                        $category_found = 0;
                        foreach ($post->categories as $this_category) {
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
            <small><a class="btn btn-sm btn-link" style="text-decoration: none;" href="{{ route('categories.create') }}">+ New category</a></small></p>
        </div>
    </div>
</div>

<div class="mb-3 mt-3">
    <label for="publication_settings">Publication Settings:</label>
</div>

<div class="mb-3">
    <label for="primary_category" class="col-form-label">Primary Category:</label>
    <select class="form-select" aria-label="Primary category" id="primary_category" name="primary_category" required>
        <option value=""></option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" @if (isset($post) && $post->primary_category_id == $category->id) selected @else @if (old('primary_category') == $category->id) selected @endif @endif>{{ $category->category_name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="visibility" class="col-form-label">Visibility:</label>
    <select class="form-select" aria-label="Post visibility options" id="visibility" name="visibility" required>
        <option value="public" @if (isset($post) && $post->visibility == 'public') selected @else @if (old('visibility') == 'public') selected @endif @endif>Public (all visitors)</option>
        <option value="paid_subscribers" @if (isset($post) && $post->visibility == 'paid_subscribers') selected @else @if (old('visibility') == 'paid_subscribers') selected @endif @endif>Paid subscribers</option>
        <option value="private" @if (isset($post) && $post->visibility == 'private') selected @else @if (old('visibility') == 'private') selected @endif @endif>Private (admins, editors, and the author only)</option>
    </select>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="publish_post" onchange="scheduleOption(event)" name="publish_post" value="1"  @if (isset($post) && !$post->is_published) notchecked @else checked @endif>
                <label class="form-check-label" for="publish_post">Publish Post</label>
            </div>
        </div>
    </div>
    <div class="col-md-4" id="scheduling_box" style="@if (isset($post) && $post->is_published != 1) display: block;  @endif">
        <div class="mb-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="schedule_publishing" onchange="publishAtOption(event)" name="schedule_publishing" value="1"   @if (isset($post) && !$post->is_scheduled) notchecked @else checked @endif>
                <label class="form-check-label" for="schedule_publishing">Schedule Publishing</label>
            </div>
        </div>

        <div class="mb-4" id="publish_at_box" style="@if (isset($post) && $post->is_scheduled != 1) display: none;  @endif">
            <label for="publish_at" class="col-form-label">Publish At:</label>
            <input type="datetime-local" class="form-control" id="publish_at" name="publish_at" min="{{ $min_time }}" value="{{ $min_time }}">
        </div>
    </div>
</div>

<div class="mb-5 mt-3 text-center">
    <input type="submit" value="@if ($purpose == 'Edit') Save Changes @else Save @endif" class="btn btn-lg btn-appprimary">
</div>