@extends('users.master')
@section('title')
    <title>Like-Debit Wallet</title>
@endsection
@section('sub_title')
    Debit Wallet
@endsection
@section('maincontianer')
    <div class="container-fluid">

        @include('users.success')




        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="h-100 py-2">
                    <div class="card-body">
                        Current Debit Balance :${{ number_format($userinfo->debit_balance, 2) }} USD
                        <div class="row no-gutters align-items-center mt-3">
                            <a href="{{ url('debit-to-withdrawal') }}" class="btn btn-primary btn-block">Withdrawal</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="h-100 py-2">
                    <div class="card-body">
                        Current Debit Balance :${{ number_format($userinfo->debit_balance, 2) }} USD
                        <div class="row no-gutters align-items-center mt-3">
                            <a href="{{ url('debit-to-transfer') }}" class="btn btn-primary btn-block">Sent to
                                investment wallet</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
