@extends('users.master')
@section('title')
    <title>Like- Account Status</title>
@endsection

@section('sub_title')
    Account Status
@endsection

@section('maincontianer')
    <div class="container-fluid">
        @include('users.success')
        @if ($investment)
            <div class="row">

                <div class="col-xl-2 col-md-6 mb-4">
                    <div class="card h-100 py-2" align="center" style="color:black; background-color:rgb(116, 58, 58);">
                        <div class="card-body">
                            <h4 style="color:green;">{{ $investment->package_name }}</h4>
                            <h4>${{ number_format($investment->invest_amount, 2) }}</h4>
                            <strong>Daily Income</strong>
                            <h4 style="color:green;">${{ number_format($investment->daily_rabit, 2) }}</h4>
                            <strong>Remaining</strong>
                            <h4 style="color:red;">{{ $investment->days }} Days</h4>
                            <strong>Actived Date</strong><br />
                            <span style="color:blue;">{{ $investment->created_at }}</span>

                        </div>
                    </div>
                </div>
                @foreach ($packages as $item)
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card h-100 py-2" align="center" style="color:black;">
                            <div class="card-body">

                                <h4 style="color:green;">{{ $item->package_name }}</h4>
                                <h4>Price : ${{ number_format($item->amount, 2) }}</h4>

                                <ul>
                                    <li>Daily Return {{ $item->rabit }}%</li>
                                    <li>{{ $item->duraction }} Days</li>
                                    <li>Total profit : $ {{ $item->total_amount }}</li>
                                    <li>{{ $item->duraction }} days after the return
                                        ${{ number_format($item->amount, 2) }} <br />total return
                                        ${{ number_format($item->amount + $item->total_amount, 2) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    </div>
@endsection
