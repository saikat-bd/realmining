<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="like">
    <meta name="author" content="like">
    <title>Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/assets/logo/favicon.png') }}" rel="icon">
    <link href="{{ asset('public/assets/logo/favicon.png') }}" rel="apple-touch-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/users/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('public/users/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/users/font_awosme/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/users/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/users/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        body .bg-theme1 {
            background-image: url({{ asset('public/login/images/bg-themes/1.png') }});
        }

        .bg-theme {
            background-size: 100% 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            transition: background .3s;
        }
    </style>
</head>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="" class="bg-theme1 bg-theme">
        <!-- Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <form action="{{ url('registerstore') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="hascode" value="{{ Request::get('username') }}">

                    <div id="container-fluid">
                        <div class="mt-2 mb-5" style="min-height: 900px">
                            <div class="col-md-6 offset-md-3">

                                <div class="pt-1 text-center">
                                    <img height="50" src="{{ asset('public/assets/logo/logo.png') }}"
                                        alt="">
                                    <h2 style="color:white; font-weight:bold;">Registration to LIKE</h2>
                                </div>

                                <div class="img-thumbnail p-5 mt-3">

                                    <div class="form-group mt-2">
                                        <label for="formGroupExampleInput">Position</label>
                                        <select name="position" id="position"
                                            class="form-control @if ($errors->has('position')) is-invalid @endif">
                                            <option value="">--Select--</option>

                                            <option value="left" @if (old('position') == 'left') selected @endif>
                                                Team A</option>
                                            <option value="right" @if (old('position') == 'right') selected @endif>
                                                Team B</option>

                                        </select>
                                        @if ($errors->has('position'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('position') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('first_name')) is-invalid @endif"
                                            id="first_name" name="first_name" value="{{ old('first_name') }}" />
                                        @if ($errors->has('first_name'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('first_name') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Last Name</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('last_name')) is-invalid @endif"
                                            id="last_name" name="last_name" value="{{ old('last_name') }}" />
                                        @if ($errors->has('last_name'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('last_name') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Username</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('username')) is-invalid @endif"
                                            id="username" name="username" value="{{ old('username') }}" />
                                        @if ($errors->has('username'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('username') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-6 col-8">
                                            <label for="formGroupExampleInput">E-mail</label>
                                            <input type="email"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                id="email" name="email" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-6 col-4">
                                            <label for="formGroupExampleInput">&nbsp;</label>
                                            <div>
                                                <button type="button" id="sendcode" class="btn btn-primary">Send
                                                    Code</button>
                                            </div>

                                        </div>
                                        <div class="col-sm-12">
                                            <div id="messages"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Verification Code</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('verifaction_code')) is-invalid @endif"
                                            id="verifaction_code" name="verifaction_code"
                                            value="{{ old('verifaction_code') }}" />
                                        @if ($errors->has('verifaction_code'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('verifaction_code') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Country Name</label>
                                        <select name="country_id" id="country_id"
                                            class="form-control @if ($errors->has('country_id')) is-invalid @endif">
                                            <option value="">--Select--</option>
                                            @foreach ($countrys as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('country_id') == $item->id) selected @endif>
                                                    {{ $item->country_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('country_id'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('country_id') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Phone Number</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                            id="phone_number" name="phone_number"
                                            value="{{ old('phone_number') }}" />
                                        @if ($errors->has('phone_number'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('phone_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Gender</label>
                                        <select name="gender" id="gender"
                                            class="form-control @if ($errors->has('gender')) is-invalid @endif">
                                            <option value="">--Select--</option>
                                            <option value="Male" @if (old('gender') == 'Male') selected @endif>
                                                Male</option>
                                            <option value="Female" @if (old('gender') == 'Female') selected @endif>
                                                Female</option>
                                            <option value="Others" @if (old('gender') == 'Others') selected @endif>
                                                Others</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Password</label>
                                        <input type="password"
                                            class="form-control @if ($errors->has('password')) is-invalid @endif"
                                            autocomplete="new-password" id="password" name="password" />
                                        @if ($errors->has('password'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Confirm Password</label>
                                        <input type="password"
                                            class="form-control @if ($errors->has('confirm_password')) is-invalid @endif"
                                            autocomplete="new-password" id="confirm_password"
                                            name="confirm_password" />
                                        @if ($errors->has('confirm_password'))
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $errors->first('confirm_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="terms"
                                                id="terms" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Accept all terms and
                                                conditions</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Register
                                        Now</button>
                                </div>


                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/users/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/users/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/users/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/users/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('public/users/vendor/chart.js/Chart.min.js') }} "></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('public/users/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/users/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('public/users/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/users/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('public/users/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('public/users/js/jquery.syotimer.min.js') }}"></script>

</body>

</html>



<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }


    jQuery(function($) {
        /* Simple Timer. The countdown to 20:30 2035.05.09 */

        $(document).on('click', '#sendcode', function() {
            var email = $('#email').val();
            $.ajax({
                url: '{{ url('sendcode') }}',
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: email
                },

                success: function(data) {
                    console.log(data);
                    $('#messages').html(data);
                }
            });

        });

        /* Periodic Timer. Period is equal 3 minutes. Effect of fading in */
        $('#periodic-timer_period_minutes').syotimer({
            year: 2020,
            month: 2,
            day: 2,
            hour: 24,
            minute: 0,
            layout: 'hms',
            doubleNumbers: false,
            effectType: 'opacity',
            periodUnit: 'm',
            periodic: true,
            periodInterval: 1440
        });

    });
</script>
