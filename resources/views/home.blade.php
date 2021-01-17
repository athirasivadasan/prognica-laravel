@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Welcom {{ Auth::user()->name }},<br>
                    You are logged in!
                    <hr>

                    <button class="btn btn-info postbutton">Click To View Details</button>
                    <div class="result" style="display:none">
                        <span class="float-right"></span>
                        <br><br>
                        <h5>Report Findings</h5>
                        <div class="row">
                            <div class="col-md-4 img_location"></div>
                            <div class="col-md-4 img_original"></div>
                            <div class="col-md-4 img_result"></div>

                        </div>
                        <br>
                        <div class="writeinfo"></div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection