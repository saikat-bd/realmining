@extends('users.master')
@section('title')
    <title>Withdrawal</title>
@endsection
@section('sub_title')
    withdrawal
@endsection
@section('style')
    <style>
        .eye {
            position: absolute;
            margin-top: -27px;
            right: 0;
            padding-right: 30px;
            cursor: pointer;
        }

        #hide1 {
            display: none;
        }
    </style>
@endsection

@section('maincontianer')
    <div class="container-fluid">


        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('debit-to-withdrawal') }}">Withdrawal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('withdrawal-report') }}">Withdrawal Report</a>
                </li>

            </ul>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <form action="{{ url('debit-to-withdrawal') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="card mb-2">
                        <div class="p-3">
                            Available Balance<br />
                            <span
                                style="font-weight: bold; color:green;">${{ number_format($userinfo->transfer_balance, 2) }}
                                USD</span>
                        </div>
                    </div>

                    @include('users.success')




                    <div class="form-group">
                        <label for="formGroupExampleInput">Account Name</label>
                        <select class="form-control @if ($errors->has('account_name')) is-invalid @endif" name="account_name"
                            id="account_name">
                            <option value="">--Select--</option>
                            <option value="BEP20" @if (old('account_name') == 'BEP20') selected @endif>BEP20</option>
                            <option value="TRC20" @if (old('account_name') == 'TRC20') selected @endif>TRC20</option>
                        </select>
                        @if ($errors->has('account_name'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('account_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Wallet Address</label>
                        <input type="text" class="form-control @if ($errors->has('binance_id')) is-invalid @endif"
                            id="binance_id" name="binance_id" value="{{ old('binance_id') }}" />
                        @if ($errors->has('binance_id'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('binance_id') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="formGroupExampleInput">Amount</label>
                        <input type="number" min="1"
                            class="form-control @if ($errors->has('amount')) is-invalid @endif" id="amount"
                            name="amount" value="{{ old('amount') }}" />
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
                            value="{{ old('transation_pin') }}" name="transation_pin" />
                        <span class="eye toggle-password">
                            <i id="hide1" class="hideshow fa fa-eye"></i>
                            <i id="hide2" class="hideshow fa fa-eye-slash"></i>
                        </span>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.hideshow').click(function() {

                var paswd = $('#transation_pin');

                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#hide1').css('display', 'block');
                    $('#hide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#hide1').css('display', 'none');
                    $('#hide2').css('display', 'block');

                }
            })
        });
    </script>
@endsection
