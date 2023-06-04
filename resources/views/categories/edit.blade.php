@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $category->category_name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('categories.index') }}">All Categories</a></li>
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <form action="{{ route('categories.update', $category) }}" method="post" class="form-card">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Category Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Name of new category" name="category_name"  value="{{ $category->category_name }}" autocomplete="category_name" required>
                                                                
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3 pt-3">
              <div class="col-sm-10 offset-sm-2">
                <input type="submit" value="Save Changes" class="btn btn-lg btn-appprimary">
              </div>
            </div>
        </form>
    </div>
</div>
@endsection
