@extends('users.master')
@section('title')
    <title>Share Plan</title>
@endsection
@section('sub_title')
    Share Plan
@endsection
@section('style')
    <style>



    </style>
@endsection

@section('maincontianer')
    <div class="container-fluid">

        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('exclusive-plan') }}">Share Plan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('exclusive-report') }}">Share Report</a>
                </li>

            </ul>
        </div>
        @include('users.success')
        <div class="row">

            @foreach ($exlusiveplan as $item)
                <div class="col-xl-6 col-md-6 mb-1">
                    <div class="h-100 py-2">
                        <div class="img-thumbnail">
                            <div class="row no-gutters align-items-center p-2">
                                <div class="col" align="center">
                                    <div class="h5 mb-2 font-weight-bold text-white-800">
                                        {{ $item->plan_name }} <br />
                                    </div>
                                    <h4> ${{ $item->plan_amount }} USD</h4>
                                    <div style="text-align: left">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row no-gutters align-items-center m-2">
                                <a onclick="return confirm('Are you sure buy exclusive plan?')"
                                    href="{{ url('buyexclusive-plan/' . $item->id) }}" class="btn btn-primary btn-block">Buy
                                    Share Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>

    </div>
@endsection
