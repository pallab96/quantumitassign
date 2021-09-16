@extends('layout.master')
@section('title')
    Dashboard
@endsection
@section('container')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-sm-4 mt-5">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
        </div>
        <div class="col-lg-5 section">
            <div>
                Total Companies
                <h2 class="mt-3">{{$total_c}}</h2>
            </div>
        </div>
        <div class="col-lg-5 section">
            <div>
                Total Employees
                <h2 class="mt-3">{{$total_e}}</h2>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
    <style>
        .section{
            -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            padding: 20px;
            border-radius: 5px;
            margin: 20px;
        }
    </style>

@endsection
