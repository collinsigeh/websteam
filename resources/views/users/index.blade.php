@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User Accounts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">User Accounts</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <div class="data-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center d-none d-md-table-cell">Admin</th>
                            <th class="text-center d-none d-md-table-cell">Editor</th>
                            <th class="text-center d-none d-md-table-cell">Author</th>
                            <th class="text-center d-none d-xl-table-cell">Primary User</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    @if ($user->is_active)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    @if ($user->is_admin)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    @if ($user->is_editor)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    @if ($user->is_author)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center d-none d-xl-table-cell">
                                <a href="{{ route('users.edit', $user) }}" class="app-table-link">
                                    @if ($user->is_primary_user)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td width="40">
                                <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user) }}" title="Edit"><i class="fas fa-pencil"></i></a>
                            </td>
                            <td width="40">
                                @if ($user->id !== Auth::user()->id && $user->is_primary_user !== 1)
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id }}" title="Delete"><i class="fa-regular fa-circle-xmark"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>

@foreach ($users as $user)
@include('inc.confirm_user_delete')
@endforeach

@endsection
