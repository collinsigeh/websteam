@extends('layouts.web')

@section('content')

<section>
    <div id="page-title">
        <h1>Donate</h1>
    </div>
    <div id="page-body">
        <div class="p-3"></div>
        <div class="page-section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image">
                        <img src="web_assets/img/penglobal_associates_limited.png" alt="{{ config('app.name') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="sub-title"><h3>Support Our Work</h3></div>
                        
                        <p>
                            Kindly send your donations to:
                        </p>
                        <table class="table table-borderless">
                            <tr>
                                <td><small>Bank Name:</small></td>
                                <td>UBA Plc</td>
                            </tr>
                            <tr>
                                <td width="150px"><small>Account Number:</small></td>
                                <td>1025916363</td>
                            </tr>
                            <tr>
                                <td><small>Account Name:</small></td>
                                <td>PENGLOBAL ASSOCIATES LIMITED</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection