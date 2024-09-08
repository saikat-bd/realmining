@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Register</title>
@endsection
<style>
    .eye {
        position: absolute;
        margin-top: 0px;
        right: 0;
        padding-right: 50px;
        cursor: pointer;
    }

    #hide1 {
        display: none;
    }

    #con_hide1 {
        display: none;
    }

    .btn {
        background: red !important;
    }
</style>
@section('maincontent')
    <div class="main-wrapper">


        <!-- Login section start -->
        <section class="registration-section pt-100 pb-100">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="registration-wrapper section--bg">
                            <form class="transparent-form verify-gcaptcha" action="{{ url('createaccountstore') }}"
                                method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">

                                    <div class="col-lg-6 form-group">
                                        <label for="username">First Name <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-user"></i>
                                            <input id="first_name" type="text" class="form--control checkUser"
                                                name="first_name" autocomplete="off" placeholder="First Name"
                                                value="{{ old('first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <small class="text-danger usernameExist">
                                                    {{ $errors->first('first_name') }}</small>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <label for="username">Last Name <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-user"></i>
                                            <input id="last_name" type="text" class="form--control checkUser"
                                                name="last_name" autocomplete="off" placeholder="Last Name"
                                                value="{{ old('last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <small class="text-danger usernameExist">
                                                    {{ $errors->first('last_name') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <label for="username">Reference <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-user"></i>
                                            <input id="reference" type="text" class="form--control checkUser"
                                                name="reference" placeholder="Email ID" value="{{ old('reference') }}">
                                            @if ($errors->has('reference'))
                                                <small class="text-danger usernameExist">
                                                    {{ $errors->first('reference') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <label for="email">E-Mail Address <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-envelope"></i>
                                            <input id="email" type="email" class="form--control checkUser"
                                                name="email" value="{{ old('email') }}" placeholder="Email">
                                            @if ($errors->has('email'))
                                                <small class="text-danger usernameExist">
                                                    {{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <label>Country <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-flag"></i>
                                            <select name="country_id" id="country_id" class="form--control">
                                                @foreach ($countrys as $item)
                                                    <option data-mobile_code="{{ $item->dialing_code }}"
                                                        value="{{ $item->id }}"
                                                        @if (old('country_id') == $item->id) selected @endif>
                                                        {{ $item->country_name }}
                                                    </option>
                                                @endforeach
                                                @if ($errors->has('country_id'))
                                                    <small class="text-danger usernameExist">
                                                        {{ $errors->first('country_id') }}</small>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label>Mobile <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-envelope"></i>
                                            <div class="input-group">
                                                <span class="input-group-text mobile-code bg--base border-0 text-white">
                                                    93
                                                </span>
                                                <input type="hidden" name="mobile_code" value="93" id="mobile_code">
                                                <input type="number" name="phone_number" id="phone_number"
                                                    value="{{ old('phone_number') }}"
                                                    class="form--control checkUser form-phone" placeholder="Mobile">
                                            </div>
                                            @if ($errors->has('phone_number'))
                                                <small class="text-danger mobileExist">
                                                    {{ $errors->first('phone_number') }}</small>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="password">Password <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-key"></i>
                                            <input id="password" type="password" class="form--control" name="password"
                                                placeholder="Password">
                                            <span class="eye toggle-password" ng-click="passwordvisable()">
                                                <i id="hide1" class="hideshow 64px lar la-eye"></i>
                                                <i id="hide2" class="hideshow 64px las la-low-vision"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <small class="text-danger">
                                                {{ $errors->first('password') }}</small>
                                        @endif

                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="password-confirm">Confirm Password <sup
                                                class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-key"></i>
                                            <input id="confirm_password" type="password" class="form--control"
                                                name="confirm_password" autocomplete="new-password"
                                                placeholder="Confirm password">
                                            <span class="eye toggle-password">
                                                <i id="con_hide1" class="confim_hideshow 64px lar la-eye"></i>
                                                <i id="con_hide2" class="confim_hideshow 64px las la-low-vision"></i>
                                            </span>

                                        </div>
                                        @if ($errors->has('confirm_password'))
                                            <small class="text-danger">
                                                {{ $errors->first('confirm_password') }}</small>
                                        @endif


                                    </div>



                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn--base w-100">Register</button>
                                        <p class="text-center mt-3"> Already you have an account ? <a
                                                href="{{ url('auth') }}" class="text--base">Login Here</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div><!-- main-wrapper end -->
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#country_id', function() {
                var mobile_code = $('#country_id option:selected').attr('data-mobile_code');
                $('.mobile-code').text(mobile_code);
                $('#mobile_code').val(mobile_code);

            });
        });

        $(document).ready(function() {

            $('.hideshow').click(function() {

                var paswd = $('#password');

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

            $('.confim_hideshow').click(function() {

                var paswd = $('#confirm_password');

                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#con_hide1').css('display', 'block');
                    $('#con_hide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#con_hide1').css('display', 'none');
                    $('#con_hide2').css('display', 'block');

                }
            });


        });
    </script>
@endsection
