@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">My Profile</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">My Profile</li>
    </ol>
    <div id="dashboard-line"></div>
    @include('inc.alert_messages')
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
                                <strong>Username:</strong>
                            </div>
                            <div class="col-sm-8 col-xl-9">
                                <div class="dashboard-data-row-value">{{ $user->username }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-4 col-xl-3">
                                <strong>Name:</strong>
                            </div>
                            <div class="col-sm-8 col-xl-9">
                                <div class="dashboard-data-row-value">{{ $user->name }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-4 col-xl-3">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-sm-8 col-xl-9">
                                <div class="dashboard-data-row-value">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-4 col-xl-3">
                                <strong>Password:</strong>
                            </div>
                            <div class="col-sm-8 col-xl-9">
                                <div class="dashboard-data-row-value">&ast;&ast;&ast;&ast;&ast;&ast;&ast;&ast; <span class="change-password-link"  data-bs-toggle="modal" data-bs-target="#staticBackdropPassword">Change Password</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-4 col-xl-3">
                                <strong>Created at:</strong>
                            </div>
                            <div class="col-sm-8 col-xl-9">
                                <div class="dashboard-data-row-value">{{ $user->created_at->format('d M, Y - h:i A') }}</div>
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
                                <strong>Account status:</strong>
                            </div>
                            <div class="col-sm-7 col-xl-8">
                                <div class="dashboard-data-row-value">
                                    @if ($user->is_active == 1)
                                        <i class="fas fa-check text-success"></i> Active
                                    @else
                                        <i class="fas fa-xmark text-danger"></i> Not Active
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-5 col-xl-4">
                                <strong>Author Role:</strong>
                            </div>
                            <div class="col-sm-7 col-xl-8">
                                <div class="dashboard-data-row-value">
                                    @if ($user->is_author == 1)
                                        <i class="fas fa-check text-success"></i> Enabled
                                    @else
                                        <i class="fas fa-xmark text-danger"></i> Disabled
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-5 col-xl-4">
                                <strong>Editor Role:</strong>
                            </div>
                            <div class="col-sm-7 col-xl-8">
                                <div class="dashboard-data-row-value">
                                    @if ($user->is_editor == 1)
                                        <i class="fas fa-check text-success"></i> Enabled
                                    @else
                                        <i class="fas fa-xmark text-danger"></i> Disabled
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-5 col-xl-4">
                                <strong>Admin Role:</strong>
                            </div>
                            <div class="col-sm-7 col-xl-8">
                                <div class="dashboard-data-row-value">
                                    @if ($user->is_admin == 1)
                                        <i class="fas fa-check text-success"></i> Enabled
                                    @else
                                        <i class="fas fa-xmark text-danger"></i> Disabled
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-data-row">
                        <div class="row">
                            <div class="col-sm-5 col-xl-4">
                                <strong>Prime User Role:</strong>
                            </div>
                            <div class="col-sm-7 col-xl-8">
                                <div class="dashboard-data-row-value">
                                    @if ($user->is_primary_user == 1)
                                        <i class="fas fa-check text-success"></i> Enabled
                                    @else
                                        <i class="fas fa-xmark text-danger"></i> Disabled
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="dashboard-card-title">
            <h5>Member Subscription:</h5>
        </div>
        <div class="dashboard-data-card">
            @if (!$user->paid_subscription_end_at || now() >= $user->paid_subscription_end_at)
                <div class="alert alert-info">
                    You do NOT have an active subscription at the moment.
                </div>
            @else
                <div class="alert alert-primary">
                    Details loading...
                </div>
            @endif
        </div>
    </div>
</div>

@include('inc.change_password')

@endsection
