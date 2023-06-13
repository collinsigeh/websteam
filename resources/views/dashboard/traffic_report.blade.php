@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Traffic Report</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a class="app-link" href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Traffic Report</li>
    </ol>
    <div id="dashboard-line"></div>
    @include('inc.alert_messages')
    <div class="dashboard-section">
        <div class="dashboard-card-title">
            <h5>Traffic Summary:</h5>
        </div>
        <div class="dashboard-data-card">
            <div class="row">
                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>TRAFFIC FOR PAST 7 DAYS</h6>
                        <div class="dashboard-card-main-item">{{ $past_7_days_total }}</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>TRAFFIC FOR PAST MONTH</h6>
                        <div class="dashboard-card-main-item">{{ $past_month_total }}</div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="dashboard-card-item">
                        <h6>TRAFFIC FOR PAST YEAR</h6>
                        <div class="dashboard-card-main-item">{{ $past_year_total }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="dashboard-section">
                <div class="dashboard-card-title">
                    <h5>Traffic Source For Past 7 Days:</h5>
                </div>
                <div class="dashboard-data-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Source Location</th>
                                    <th>Total traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nigeria</td>
                                    <td>{{ $nigerian_7_days_total }}</td>
                                </tr>
                                <tr>
                                    <td>Africa</td>
                                    <td>{{ $african_7_days_total }}</td>
                                </tr>
                                <tr>
                                    <td>United Kingdom</td>
                                    <td>{{ $uk_7_days_total }}</td>
                                </tr>
                                <tr>
                                    <td>Europe</td>
                                    <td>{{ $europe_7_days_total }}</td>
                                </tr>
                                <tr>
                                    <td>Worldwide</td>
                                    <td>{{ $past_7_days_total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="dashboard-card-title">
                    <h5>Traffic Source For Past Month:</h5>
                </div>
                <div class="dashboard-data-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Source Location</th>
                                    <th>Total traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nigeria</td>
                                    <td>{{ $nigerian_1_month_total }}</td>
                                </tr>
                                <tr>
                                    <td>Africa</td>
                                    <td>{{ $african_1_month_total }}</td>
                                </tr>
                                <tr>
                                    <td>United Kingdom</td>
                                    <td>{{ $uk_1_month_total }}</td>
                                </tr>
                                <tr>
                                    <td>Europe</td>
                                    <td>{{ $europe_1_month_total }}</td>
                                </tr>
                                <tr>
                                    <td>Worldwide</td>
                                    <td>{{ $past_month_total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="dashboard-card-title">
                    <h5>Traffic Source For Past Year:</h5>
                </div>
                <div class="dashboard-data-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Source Location</th>
                                    <th>Total traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nigeria</td>
                                    <td>{{ $nigerian_1_year_total }}</td>
                                </tr>
                                <tr>
                                    <td>Africa</td>
                                    <td>{{ $african_1_year_total }}</td>
                                </tr>
                                <tr>
                                    <td>United Kingdom</td>
                                    <td>{{ $uk_1_year_total }}</td>
                                </tr>
                                <tr>
                                    <td>Europe</td>
                                    <td>{{ $europe_1_year_total }}</td>
                                </tr>
                                <tr>
                                    <td>Worldwide</td>
                                    <td>{{ $past_year_total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="dashboard-section">
                <div class="dashboard-card-title">
                    <h5>Recent Traffic:</h5>
                </div>
                <div class="dashboard-data-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>Country</th>
                                    <th>Continent</th>
                                    <th>Visited at</th>
                                    <th>Page</th>
                                    <th>Referrer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_traffic as $traffic)
                                    <tr>
                                        <td>{{ $traffic->ip }}</td>
                                        <td>{{ $traffic->country }}</td>
                                        <td>{{ $traffic->continent }}</td>
                                        <td>{{ $traffic->created_at->diffForHumans() }}</td>
                                        <td>{{ $traffic->page }}</td>
                                        <td>{{ $traffic->referrer }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
