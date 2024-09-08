@extends('users.master')
@section('title')
    <title>Like-Credit Wallet</title>
@endsection

@section('sub_title')
    Credit Wallet
@endsection

@section('maincontianer')
    <div class="container-fluid">

        @include('users.success')




        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="h-100 py-2">
                    <div class="card-body">
                        Current Credit Balance :${{ number_format($userinfo->credit_balance, 2) }} USD
                        <div class="row no-gutters align-items-center mt-3">
                            <a href="{{ url('credit-to-transfer') }}" class="btn btn-primary btn-block">Send to Investment
                                Wallet</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="h-100 py-2">
                    <div class="card-body">
                        Current Credit Balance :${{ number_format($userinfo->credit_balance, 2) }} USD
                        <div class="row no-gutters align-items-center mt-3">
                            <a href="{{ url('credit-to-debit') }}" class="btn btn-primary btn-block">Send to Debit
                                Wallet</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
