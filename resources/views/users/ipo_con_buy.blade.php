@extends('users.master')
@section('title')
    <title>IPO Coin</title>
@endsection
@section('sub_title')
    IPO Coin
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
    <div class="container-fluid mt-3">

        <div id="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <form action="{{ url('ipocoinstore') }}" method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $coininfo->id }}">



                        <div class="card mb-2">
                            <div class="p-3">
                                Available Balance<br />
                                <span
                                    style="font-weight: bold; color:green;">${{ number_format($userinfo->transfer_balance, 2) }}
                                    USD</span>
                            </div>
                            <div class="p-3">
                                Coin Name : {{ $coininfo->coin_name }} <br />
                                Price : ${{ number_format($coininfo->rate, 2) }} <br />
                            </div>
                        </div>

                        @include('users.success')





                        <div class="form-group">
                            <label for="formGroupExampleInput">Quantity</label>
                            <input type="number" min="200"
                                class="form-control @if ($errors->has('quantity')) is-invalid @endif" id="quantity"
                                name="quantity" />
                            @if ($errors->has('quantity'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="transaction">Transaction PIN</label>
                            <input type="password" autocomplete="new-password"
                                class="form-control @if ($errors->has('transation_pin')) is-invalid @endif" id="transation_pin"
                                name="transation_pin" />
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

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.withJquery', function() {
                const textToCopy = $(this).attr('data-address');
                navigator.clipboard.writeText(textToCopy);
                $(this).text('Copyed');
            });

        });
    </script>
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
