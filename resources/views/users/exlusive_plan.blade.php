@extends('users.master')
@section('title')
    <title>Exclusive Plan</title>
@endsection
@section('sub_title')
    Exclusive Plan
@endsection
@section('style')
    <style>
        .img-thumbnail {
            background-color: #192D36;
            border: 2px solid #2F5464;
        }

        .img-thumbnail h5 {
            font-size: 16px;
            line-height: 25px;
        }

        .btn-primary:hover {
            background-color: #1F363F;
            border-color: #1F363F;
        }
    </style>
@endsection

@section('maincontianer')
    <div class="container-fluid">
        @include('users.success')
        <div class="row">

            @foreach ($exlusiveplan as $item)
                <div class="col-xl-6 col-md-6 mb-1">
                    <div class="h-100 py-2" style="color:white;">
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
                                    Exclusive Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>

    </div>
@endsection
