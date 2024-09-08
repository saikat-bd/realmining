@extends('users.master')
@section('title')
    <title>Like-Royalty to Debit</title>
@endsection
@section('sub_title')
    Royalty to Debit
@endsection
@section('maincontianer')
    <div class="container-fluid">

        <div id="container-fluid">
            <div class="row">




                <div class="col-lg-12">
                    <form action="{{ url('royalty-to-debit') }}" method="post">
                        <h2>Royalty Wallet to Debit</h2>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <strong>Current royalty balance : ${{ number_format($userinfo->earn_balance, 2) }} USD</strong>
                        <hr>

                        @include('users.success')


                        <div class="form-group">
                            <label for="formGroupExampleInput">Amount</label>
                            <input type="number" min="1"
                                class="form-control @if ($errors->has('amount')) is-invalid @endif" id="amount"
                                name="amount" />
                            @if ($errors->has('amount'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput">Transaction PIN</label>
                            <input type="password" autocomplete="new-password"
                                class="form-control @if ($errors->has('transation_pin')) is-invalid @endif" id="transation_pin"
                                name="transation_pin" />
                            @if ($errors->has('transation_pin'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $errors->first('transation_pin') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
