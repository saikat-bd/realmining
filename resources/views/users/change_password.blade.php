@extends('users.master')
@section('title')
    <title>Like-Change Password</title>
@endsection
@section('sub_title')
    Change Password
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

        #newhide1,
        #cureenpinhide1,
        #newpinhide1 {
            display: none;
        }
    </style>
@endsection
@section('maincontianer')
    <div class="container-fluid">

        <div id="container-fluid">
            <div class="row">




                <div class="col-lg-12">
                    <form action="{{ url('password-update') }}" method="post">
                        <h2>Change Password</h2>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('users.success')

                        <div class="form-group">
                            <label for="formGroupExampleInput">Current Password</label>
                            <input type="password" autocomplete="new-password"
                                class="form-control @if ($errors->has('current_password')) is-invalid @endif"
                                id="current_password" name="current_password" />
                            <span class="eye toggle-password">
                                <i id="hide1" class="hideshow fa fa-eye"></i>
                                <i id="hide2" class="hideshow fa fa-eye-slash"></i>
                            </span>
                            @if ($errors->has('current_password'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $errors->first('current_password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput">New Password</label>
                            <input type="password" class="form-control @if ($errors->has('new_password')) is-invalid @endif"
                                id="new_password" name="new_password" autocomplete="off" />
                            <span class="eye toggle-password">
                                <i id="newhide1" class="newhideshow fa fa-eye"></i>
                                <i id="newhide2" class="newhideshow fa fa-eye-slash"></i>
                            </span>
                            @if ($errors->has('new_password'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $errors->first('new_password') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Change Password</button>
                    </form>
                </div>
                @if ($userinfo->transactionpin)
                    <div class="col-lg-12 mt-3">
                        <form action="{{ url('transaction-pin-update') }}" method="post">
                            <h2>Transaction PIN</h2>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="formGroupExampleInput">Current PIN</label>
                                <input type="password" autocomplete="new-password"
                                    class="form-control @if ($errors->has('current_pin')) is-invalid @endif"
                                    id="current_pin" name="current_pin" />
                                <a href="{{ url('forgot-transactionpin') }}"
                                    onclick="return confirm('Are you sure forgot transaction pin')"
                                    style="color:red;">Forgot Transaction</a>
                                <span class="eye toggle-password">
                                    <i id="cureenpinhide1" class="curenhideshow fa fa-eye"></i>
                                    <i id="cureenpinhide2" class="curenhideshow fa fa-eye-slash"></i>
                                </span>
                                @if ($errors->has('current_pin'))
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $errors->first('current_pin') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput">New PIN</label>
                                <input type="password"
                                    class="form-control @if ($errors->has('newpin')) is-invalid @endif" id="newpin"
                                    name="newpin" autocomplete="off" />
                                <span class="eye toggle-password">
                                    <i id="newpinhide1" class="newpinhideshow fa fa-eye"></i>
                                    <i id="newpinhide2" class="newpinhideshow fa fa-eye-slash"></i>
                                </span>
                                @if ($errors->has('newpin'))
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $errors->first('newpin') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Change Transaction PIN</button>
                        </form>
                    </div>
                @else
                    <div class="col-lg-12 mt-3">
                        <form action="{{ url('transaction-pin') }}" method="post">
                            <h2>Transaction PIN</h2>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">



                            <div class="form-group">
                                <label for="formGroupExampleInput">New PIN</label>
                                <input type="password" autocomplete="new-password"
                                    class="form-control @if ($errors->has('new_pin')) is-invalid @endif" id="new_pin"
                                    name="new_pin" />
                                @if ($errors->has('new_pin'))
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $errors->first('new_pin') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput">Confirm PIN</label>
                                <input type="password"
                                    class="form-control @if ($errors->has('confirm_pin')) is-invalid @endif"
                                    id="confirm_pin" name="confirm_pin" autocomplete="off" />
                                @if ($errors->has('confirm_pin'))
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $errors->first('confirm_pin') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Transaction PIN</button>
                        </form>
                    </div>
                @endif



            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.hideshow').click(function() {
                var paswd = $('#current_password');
                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#hide1').css('display', 'block');
                    $('#hide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#hide1').css('display', 'none');
                    $('#hide2').css('display', 'block');

                }
            });

            $('.newhideshow').click(function() {
                var paswd = $('#new_password');
                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#newhide1').css('display', 'block');
                    $('#newhide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#newhide1').css('display', 'none');
                    $('#newhide2').css('display', 'block');

                }
            });

            $('.curenhideshow').click(function() {
                var paswd = $('#current_pin');
                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#cureenpinhide1').css('display', 'block');
                    $('#cureenpinhide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#cureenpinhide1').css('display', 'none');
                    $('#cureenpinhide2').css('display', 'block');

                }
            });

            $('.newpinhideshow').click(function() {
                var paswd = $('#newpin');
                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#newpinhide1').css('display', 'block');
                    $('#newpinhide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#newpinhide1').css('display', 'none');
                    $('#newpinhide2').css('display', 'block');

                }
            });

        });
    </script>
@endsection
