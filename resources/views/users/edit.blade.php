@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $user->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('users.index') }}">User Accounts</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>
    <div id="dashboard-line"></div>
    @include('inc.alert_messages')

    <div class="dashboard-section">
        <div class="dashboard-card-title">
            <h5>Account Summary:</h5>
        </div>
        <div class="dashboard-data-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="dashboard-card-item">
                        <h6>POSTS CREATED</h6>
                        <div class="dashboard-card-main-item">{{ $user->posts->count() }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dashboard-card-item" style="min-height: 135px">
                        <div class="row">
                            <div class="col-6">
                                <h6>Created On:</h6>
                                <P>{{ $user->created_at->format('d M, Y') }}</P>
                            </div>
                            <div class="col-6">
                                <h6>Last Updated:</h6>
                                <P>{{ $user->updated_at->diffForHumans() }}</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <form action="{{ route('users.update', $user) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-lg-6">
                <div class="dashboard-section">
                    <div class="dashboard-card-title">
                        <h5>Profile Information:</h5>
                    </div>
                    <div class="dashboard-data-card">
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-4 col-xl-3">
                                    <label for="username">Username:</label>
                                </div>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="username" value="{{ $user->username }}" id="username" class="form-control @error('username') is-invalid @enderror" required>
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-4 col-xl-3">
                                    <label for="name">Name:</label>
                                </div>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-4 col-xl-3">
                                    <label for="email">Email:</label>
                                </div>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                </div>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-4 col-xl-3">
                                    <label for="password">Password <small>(optional)</small>:</label>
                                </div>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-4 col-xl-3">
                                    <label for="password_confirmaton">Confirm Password:</label>
                                </div>
                                <div class="col-sm-8 col-xl-9">
                                    <input type="password" name="password_confirmaton" id="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dashboard-section">
                    <div class="dashboard-card-title">
                        <h5>Account Settings:</h5>
                    </div>
                    <div class="dashboard-data-card">
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-5 col-xl-4">
                                    <label for="account-status">Account status:</label>
                                </div>
                                <div class="col-sm-7 col-xl-8">
                                    <select name="account_status" class="form-select" id="account-status">
                                        @if ($user->is_active == 1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">Disable</option>
                                        @else
                                            <option value="0" selected>Not Active</option>
                                            <option value="1">Activate</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-5 col-xl-4">
                                    <label for="author-role">Author Role:</label>
                                </div>
                                <div class="col-sm-7 col-xl-8">
                                    <select name="author_role" class="form-select" id="author-role">
                                        @if ($user->is_author == 1)
                                            <option value="1" selected>Enabled</option>
                                            <option value="0">Disable</option>
                                        @else
                                            <option value="0" selected>Disabled</option>
                                            <option value="1">Enable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-5 col-xl-4">
                                    <label for="editor-role">Editor Role:</label>
                                </div>
                                <div class="col-sm-7 col-xl-8">
                                    <select name="editor_role" class="form-select" id="editor-role">
                                        @if ($user->is_editor == 1)
                                            <option value="1" selected>Enabled</option>
                                            <option value="0">Disable</option>
                                        @else
                                            <option value="0" selected>Disabled</option>
                                            <option value="1">Enable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-5 col-xl-4">
                                    <label for="admin-role">Admin Role:</label>
                                </div>
                                <div class="col-sm-7 col-xl-8">
                                    <select name="admin_role" class="form-select" id="admin-role">
                                        @if ($user->is_admin == 1)
                                            <option value="1" selected>Enabled</option>
                                            <option value="0">Disable</option>
                                        @else
                                            <option value="0" selected>Disabled</option>
                                            <option value="1">Enable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        @if (Auth::user()->is_primary_user == 1)
                        <div class="dashboard-data-row">
                            <div class="row">
                                <div class="col-sm-5 col-xl-4">
                                    <label for="prime">Primary User Role:</label>
                                </div>
                                <div class="col-sm-7 col-xl-8">
                                    <select name="primary_user_role" class="form-select" id="prime">
                                        @if ($user->is_primary_user == 1)
                                            <option value="1" selected>Enabled</option>
                                            <option value="0">Disable</option>
                                        @else
                                            <option value="0" selected>Disabled</option>
                                            <option value="1">Enable</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <small>NOTE: Enabling the <strong>Primary User Role</strong> for this user will disable it for all other user accounts.</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        @include('inc.user_edit_delete_button')
    </form>
</div>

@include('inc.confirm_user_delete')

@endsection
