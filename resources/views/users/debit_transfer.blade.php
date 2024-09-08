@extends('users.master')
@section('title')
    <title>Like-Debit Wallet to Investment</title>
@endsection

@section('sub_title')
    Debit Wallet to Investment
@endsection
@section('maincontianer')
    <div class="container-fluid">

        <div id="container-fluid">
            <div class="row">




                <div class="col-lg-12">
                    <form action="{{ url('debit-to-transfer') }}" method="post">
                        <h2>Debit Wallet to Investment</h2>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <strong>Current debit balance : ${{ number_format($userinfo->debit_balance, 2) }} USD</strong>
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
