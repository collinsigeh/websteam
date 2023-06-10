@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Settings</li>
    </ol>
    <div class="mb-4"> 
        @include('inc.alert_messages')

        <form action="{{ route('settings.update') }}" method="post" class="form-card">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="production_settings" class="col-form-label">Production Settings:</label>
                </div>
                <div class="col-md-9">
                    <select class="form-select" aria-label="Production setting options" id="production_settings" name="production_settings" required
                    @if (auth()->user()->is_admin != 1)
                        disabled
                    @endif
                >
                        <option value="{{ $setting->is_live }}" selected>
                            @if ($setting->is_live == 1)
                                Live & Running
                            @else
                                NOT Running
                            @endif
                        </option>
                        <option value=""></option>
                        @if ($setting->is_live == 1)
                            <option value="0">Diable live mode</option>
                        @else
                            <option value="1">Go live</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 pt-3 text-center">
                <input type="submit" value="Save" class="btn btn-lg btn-appprimary">
            </div>
        </form>
    </div>
</div>
@endsection
