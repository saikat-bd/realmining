@extends('users.master')
@section('title')
    <title>Dashboard</title>
@endsection

@section('sub_title')
    Dashboard
@endsection

@section('style')
    <style>
        .img-thumbnail {
            background-color: #3A46AE;
            border: none;
        }

        .img-thumbnail a {
            color: white;
            text-decoration: none;
        }

        .profile-thumbnail {
            background: #3A46AE;
            border-radius: 10px;
            color: white;
        }

        .custom-thumbnail {
            background: #606de0;
            border-radius: 10px;
        }

        .custom-thumbnail a {
            color: white;
            text-decoration: none;
        }

        .trading-thumbnail {
            background: rgb(247, 243, 243);
            border-radius: 5px;
        }
    </style>
@endsection


@section('maincontianer')
    <div class="container-fluid">
        @include('users.success')
        <div class="m-1 mt-2 pt-1 pb-3 p-2 row profile-thumbnail">
            <div class="row col-12" style="color:white; font-size:20px;">Welcome to {{ Auth::user()->name }}</div>
            <div class="row">
                <div class="col-12">
                    <table>
                        <tr>
                            <td align="right">
                                <div class="form-group mt-2">
                                    <a href="{{ url('profile-edit') }}">
                                        <img class="img-fluid" style="height:60px; width:60px;"
                                            src="{{ asset('public/photo/' . $userinfo->photo) }}"
                                            alt="{{ $userinfo->name }}"></a>
                                </div>
                            </td>
                            <td style="color: white;">Account No. {{ $userinfo->email }}<br />
                                Account Status : {{ $userinfo->status }}
                                @if ($userinfo->rank)
                                    <br />
                                    Your rank : <storn style="color:green;"> {{ $userinfo->rank->rank_name }}</storng>
                                @endif
                                @if ($userinfo->status == 'Inactive')
                                    <br />
                                    <div class="mt-2">
                                        <a href="{{ url('activeyouraccount') }}" class="btn btn-info"
                                            style="color:red;">Active
                                            Now</a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>


        <div class="row">




            <div class="col-xl-2 col-sm-4 col-6 mb-1">
                <div class="h-100 py-2" style="color:white;">
                    <div class="img-thumbnail">
                        <div class="row no-gutters align-items-center p-2">
                            <div class="col" align="center">
                                <div class="h6 mb-2 font-weight-bold text-white-800"><strong
                                        style="font-size:18px;">&#36;</strong>{{ number_format($userinfo->transfer_balance, 2) }}
                                    USD
                                </div>
                                <strong style="font-size:13px;">My Balance</strong>
                            </div>

                        </div>



                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-sm-4 col-6 mb-1">
                <div class="h-100 py-2" style="color:white;">
                    <div class="img-thumbnail">
                        <div class="row no-gutters align-items-center p-2">
                            <div class="col" align="center">
                                <div class="h6 mb-2 font-weight-bold text-white-800"><strong
                                        style="font-size:18px;"></strong>{{ number_format($withdrawal, 2) }} Coin
                                </div>
                                <strong style="font-size:13px;"><a href="{{ url('withdrawal-history?type=withdrawal') }}"
                                        style="color:#0082FA;">Total Coin</a></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>


        <div class="m-1 pt-1 pb-3 row custom-thumbnail">

            <div class="col-xl-2 col-6 col-md-6 mb-0">
                <div class="h-50">
                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('deposit') }}" class="btn btn-primary btn-block pt-2 pb-2">
                            Deposit</a>
                    </div>

                </div>
            </div>

            @if (Auth::user()->status == 'Active')
                <div class="col-xl-2 col-6 col-md-6 mb-0">
                    <div class="h-50">
                        <div class="mt-2" style="text-align: center">
                            <a href="{{ url('debit-to-withdrawal') }}" class="btn btn-primary btn-block">Withdrawal</a>
                        </div>

                    </div>
                </div>
            @endif


            <div class="col-xl-2 col-md-6 col-6 mb-0">
                <div class="h-50">
                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('investment') }}" class="btn btn-primary btn-block">Packages</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 col-6 mb-0">
                <div class="h-50">
                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('exclusive-plan') }}" class="btn btn-primary btn-block">Share Plan</a>
                    </div>
                </div>
            </div>


            @if (Auth::user()->status == 'Active')
                <div class="col-xl-2 col-md-6 col-6 mb-0">
                    <div class="h-50">
                        <div class="mt-2" style="text-align: center">
                            <a href="{{ url('transfer-wallet') }}" class="btn btn-primary btn-block">Transfer</a>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-xl-2 col-md-6 col-6 mb-0">
                <div class="h-50">

                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('invite-link') }}" class="btn btn-primary btn-block">Invite Link</a>
                    </div>


                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="h-50">
                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('history') }}" class="btn btn-primary btn-block">Transaction</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 col-6">
                <div class="h-50">
                    <div class="mt-2" style="text-align: center">
                        <a href="{{ url('message-center') }}" class="btn btn-primary btn-block">Help Center</a>
                    </div>

                </div>
            </div>


        </div>


        <div class="card mb-2 mt-3">
            <div class="p-1">
                <strong>IPO Coin</strong>
                <table class="table" style="width: 100%;">
                    @foreach ($coins as $item)
                        <tr>
                            <td style="border-bottom: 1px solid #0082FA; color:green;">{{ $item->coin_name }}</td>
                            <td style="border-bottom: 1px solid #0082FA; color:red;">${{ number_format($item->rate, 2) }}
                            </td>
                            <td style="text-align: right; border-bottom: 1px solid #0082FA;"><a href="">Buy</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

    </div>
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function() {
            $("#myModal").modal();
        });
    </script> --}}
@endsection
