@extends('users.master')
@section('title')
    <title>Packages</title>
@endsection
@section('sub_title')
    Packages
@endsection
@section('style')
    <style>
        .service {
            padding: 15px;
            text-align: center;
            border-radius: 20px;
            border: 2px solid #3A46AE;
            vertical-align: middle;
        }

        .service h2 {
            color: #000;
            font-weight: bold;
        }

        .service .price {
            background: #3A46AE;
            color: white;
            border: 2px solid #3A46AE;
            border-radius: 20px;
            font-size: 24px;
            font-weight: bold;
            padding: 5px 0px 5px 0px;
        }

        .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3A46AE;
        }
    </style>
@endsection

@section('maincontianer')
    <div class="container-fluid">
        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('investment') }}">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('investment-report') }}">Package Report</a>
                </li>

            </ul>
        </div>
        @include('users.success')
        <div class="row">

            @foreach ($packages as $item)
                <div class="col-xl-3 col-sm-4 col-md-6 mb-1">


                    <div class="service">
                        <h2>{{ $item->package_name }}</h2>
                        <div class="price">
                            ${{ number_format($item->amount, 2) }}
                        </div>
                        <br />
                        <div>

                            <div style="padding-top: 5px;">
                                <h5>Earning Rate ${{ number_format($item->rabit, 2) }} daily</h5>
                            </div>
                            <div style="padding-top: 5px;">
                                <strong>{{ $item->duraction }} Days</strong>
                            </div>

                            <div style="padding-top: 5px;">
                                <strong>Total Profit ${{ $item->total_amount - $item->amount }}</strong>
                            </div>
                            <div style="padding-top: 5px;">
                                <strong>You will get ${{ $item->total_amount }}</strong>
                            </div>
                        </div>
                        <hr />


                        <div style="margin-top: 30px;">
                            <a onclick="return confirm('Are you sure buy this package?')"
                                href="{{ url('investment/' . $item->id) }}" class="btn btn-primary btn-block">BUY
                                PACKAGE</a>
                        </div>
                    </div>




                </div>
            @endforeach



        </div>

    </div>
@endsection
