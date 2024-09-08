@extends('users.master')
@section('title')
    <title>Like- My Team</title>
@endsection
@section('sub_title')
    Rank
@endsection
<style>
    strong a {
        color: red;
    }

    strong a:hover {
        color: red;
        text-decoration: none;
    }
</style>
@section('maincontianer')
    <div class="container-fluid">

        @php
            
            $bronze_per = 0;
            $bronzeplus_per = 0;
            $silver_per = 0;
            $silvarplus_per = 0;
            $gold_per = 0;
            $goldplus_per = 0;
            $diamond_per = 0;
            $diamondplus_per = 0;
            $platinum_per = 0;
            $platinum_plus_per = 0;
            
            if ($userinfo->left_point > 0 && $userinfo->right_point > 0) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 3000) {
                        $bronze = 3000 / 3000;
                    } else {
                        $bronze = $userinfo->left_point / 3000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 3000) {
                        $bronze = 3000 / 3000;
                    } else {
                        $bronze = $userinfo->right_point / 3000;
                    }
                } else {
                    if ($userinfo->left_point > 3000) {
                        $bronze = 3000 / 3000;
                    } else {
                        $bronze = $userinfo->left_point / 3000;
                    }
                }
            
                $bronze_per = $bronze * 100;
            }
            if ($userinfo->left_point > 3000 && $userinfo->right_point > 3000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 10000) {
                        $bronzeplus = 10000 / 10000;
                    } else {
                        $bronzeplus = ($userinfo->left_point - 3000) / 7000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 10000) {
                        $bronzeplus = 10000 / 10000;
                    } else {
                        $bronzeplus = ($userinfo->right_point - 3000) / 7000;
                    }
                } else {
                    if ($userinfo->left_point > 10000) {
                        $bronzeplus = 10000 / 10000;
                    } else {
                        $bronzeplus = ($userinfo->left_point - 3000) / 7000;
                    }
                }
                $bronzeplus_per = $bronzeplus * 100;
            }
            
            if ($userinfo->left_point > 10000 && $userinfo->right_point > 10000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 20000) {
                        $silver = 20000 / 20000;
                    } else {
                        $silver = ($userinfo->left_point - 10000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 20000) {
                        $silver = 20000 / 20000;
                    } else {
                        $silver = ($userinfo->right_point - 10000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 20000) {
                        $silver = 20000 / 20000;
                    } else {
                        $silver = ($userinfo->left_point - 10000) / 10000;
                    }
                }
            
                $silver_per = $silver * 100;
            }
            
            if ($userinfo->left_point > 20000 && $userinfo->right_point >= 20000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 30000) {
                        $silvarplus = 30000 / 30000;
                    } else {
                        $silvarplus = ($userinfo->left_point - 20000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 30000) {
                        $silvarplus = 30000 / 30000;
                    } else {
                        $silvarplus = ($userinfo->right_point - 20000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 30000) {
                        $silvarplus = 30000 / 30000;
                    } else {
                        $silvarplus = ($userinfo->left_point - 20000) / 10000;
                    }
                }
                $silvarplus_per = $silvarplus * 100;
            }
            
            if ($userinfo->left_point >= 30000 && $userinfo->right_point >= 30000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 40000) {
                        $gold = 40000 / 40000;
                    } else {
                        $gold = ($userinfo->left_point - 30000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 40000) {
                        $gold = 40000 / 40000;
                    } else {
                        $gold = ($userinfo->right_point - 30000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 40000) {
                        $gold = 40000 / 40000;
                    } else {
                        $gold = ($userinfo->left_point - 30000) / 10000;
                    }
                }
            
                $gold_per = $gold * 100;
            }
            
            if ($userinfo->left_point >= 40000 && $userinfo->right_point >= 40000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 50000) {
                        $goldplus = 50000 / 50000;
                    } else {
                        $goldplus = ($userinfo->left_point - 40000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 50000) {
                        $goldplus = 50000 / 50000;
                    } else {
                        $goldplus = ($userinfo->right_point - 40000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 50000) {
                        $goldplus = 50000 / 50000;
                    } else {
                        $goldplus = ($userinfo->left_point - 40000) / 10000;
                    }
                }
            
                $goldplus_per = $goldplus * 100;
            }
            if ($userinfo->left_point >= 50000 && $userinfo->right_point >= 50000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 60000) {
                        $diamond = 60000 / 60000;
                    } else {
                        $diamond = ($userinfo->left_point - 50000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 60000) {
                        $diamond = 60000 / 60000;
                    } else {
                        $diamond = ($userinfo->right_point - 50000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 60000) {
                        $diamond = 60000 / 60000;
                    } else {
                        $diamond = ($userinfo->left_point - 50000) / 10000;
                    }
                }
                $diamond_per = $diamond * 100;
            }
            if ($userinfo->left_point >= 60000 && $userinfo->right_point >= 60000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 70000) {
                        $diamonplus = 70000 / 70000;
                    } else {
                        $diamonplus = ($userinfo->left_point - 60000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 70000) {
                        $diamonplus = 70000 / 70000;
                    } else {
                        $diamonplus = ($userinfo->right_point - 60000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 70000) {
                        $diamonplus = 70000 / 70000;
                    } else {
                        $diamonplus = ($userinfo->left_point - 60000) / 10000;
                    }
                }
                $diamondplus_per = $diamonplus * 100;
            }
            
            if ($userinfo->left_point >= 70000 && $userinfo->right_point >= 70000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 80000) {
                        $platinum = 80000 / 80000;
                    } else {
                        $platinum = ($userinfo->left_point - 70000) / 10000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 80000) {
                        $platinum = 80000 / 80000;
                    } else {
                        $platinum = ($userinfo->right_point - 70000) / 10000;
                    }
                } else {
                    if ($userinfo->left_point > 80000) {
                        $platinum = 80000 / 80000;
                    } else {
                        $platinum = ($userinfo->left_point - 70000) / 10000;
                    }
                }
            
                $platinum_per = $platinum * 100;
            }
            
            if ($userinfo->left_point >= 80000 && $userinfo->right_point >= 80000) {
                if ($userinfo->left_point == $userinfo->right_point) {
                    if ($userinfo->left_point > 100000) {
                        $platinum_plus = 100000 / 100000;
                    } else {
                        $platinum_plus = ($userinfo->left_point - 80000) / 20000;
                    }
                } elseif ($userinfo->left_point > $userinfo->right_point) {
                    if ($userinfo->right_point > 100000) {
                        $platinum_plus = 100000 / 100000;
                    } else {
                        $platinum_plus = ($userinfo->right_point - 80000) / 20000;
                    }
                } else {
                    if ($userinfo->left_point > 100000) {
                        $platinum_plus = 100000 / 100000;
                    } else {
                        $platinum_plus = ($userinfo->left_point - 80000) / 20000;
                    }
                }
                $platinum_plus_per = $platinum_plus * 100;
            } else {
                $bronze = 0;
            }
            
        @endphp


        <div class="row mb-5">

            <div class="col-lg-12 rounded shadow-lg"
                style="height: 210px; padding:10px; background-color: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,25,1) 10%, rgba(1,0,17,1) 24%, rgba(0,0,0,1) 27%, rgba(9,9,121,1) 47%, rgba(0,212,255,1) 92%);"
                align="center">

                <strong style="font-size: 24px;">
                    <a data-toggle="collapse" href="#bronze" role="button" aria-expanded="false"
                        aria-controls="bronze">Bronze</a></strong><br /><br />
                <div class="progress">

                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $bronze_per }}%; color:red;"
                        aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">{{ number_format($bronze_per) }}%</div>

                </div>
                <p style="margin-top:5px;">Congratulations : {{ Auth::user()->name }} Best wishes from Like family for
                    achieving
                    the rank. Earn next rank to get more opportunities to earn more Thanks.</p>

            </div>


            <div class="collapse" id="bronze">
                <div class="card card-body" style="color:black;">
                    Bronze (If Team A Sales $ 3000.00 USD and Team B Sales $3000.00 total sales $6000.00 USD, You will
                    become bronze customer you will get $50 USD 3 months)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background-color: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(113,154,47,1) 26%, rgba(121,171,33,1) 31%, rgba(0,1,25,1) 44%, rgba(51,51,113,1) 54%, rgba(94,189,126,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">
                <strong style="font-size: 24px;"><a data-toggle="collapse" href="#bronzeplus" role="button"
                        aria-expanded="false" aria-controls="bronzeplus">Bronze+</a></strong><br />
                @if ($bronzeplus_per > 0)
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $bronzeplus_per }}%"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($bronzeplus_per, 2) }}%
                        </div>

                    </div>
                    <p style="margin-top:5px;">Congratulations : {{ Auth::user()->name }} Best wishes from Like family for
                        achieving the rank. Earn next rank to get more opportunities to earn more Thanks.</p>
                @else
                    <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                    <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                        There are also various types of facilities</p>
                @endif
            </div>

            <div class="collapse" id="bronzeplus">
                <div class="card card-body" style="color:black;">
                    Bronze+ (If Team A Sales $10000.00 USD and Team B Sales $10000.00 total sales $20000.00 USD, You will
                    become bronze+ customer you will get cozbazar tour)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background-color: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(33,126,171,1) 31%, rgba(0,1,25,1) 44%, rgba(51,51,113,1) 54%, rgba(145,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">
                <strong><a data-toggle="collapse" href="#silvar" role="button" aria-expanded="false"
                        aria-controls="silvar"><strong style="font-size: 24px;">Silvar</strong></a></strong>

                <br />
                @if ($silver_per > 0)
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $silver_per }}%"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($silver_per, 2) }}%
                        </div>
                    </div>
                    <p style="margin-top:5px;">Congratulations : {{ Auth::user()->name }} Best wishes from Like family for
                        achieving the rank. Earn next rank to get more opportunities to earn more Thanks.</p>
                @else
                    <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                    <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                        There are also various types of facilities</p>
                @endif
            </div>

            <div class="collapse" id="silvar">
                <div class="card card-body" style="color:black;">
                    Silver (If Team A Sales $20000.00 USD and Team B Sales $20000.00 total sales $40000.00 USD, You will
                    become Silver customer you will get $100.00 USD 3 months)
                </div>
            </div>



            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background-color: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(33,126,171,1) 31%, rgba(0,1,25,1) 44%, rgba(51,51,113,1) 54%, rgba(140,167,97,1) 62%, rgba(160,153,98,1) 69%, rgba(102,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">
                <a data-toggle="collapse" href="#silvarplus" role="button" aria-expanded="false"
                        aria-controls="silvarplus"><strong style="font-size: 24px;">Silvar+</strong></a><strong><br />
                        @if ($silvarplus_per > 0)
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $silver_per }}%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($silver_per, 2) }}%
                                </div>
                            </div>
                            <p style="margin-top:5px;">Congratulations : {{ Auth::user()->name }} Best wishes from Like
                                family for
                                achieving the rank. Earn next rank to get more opportunities to earn more Thanks.</p>
                        @else
                            <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                            <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving
                                rank.
                                There are also various types of facilities</p>
                        @endif
            </div>

            <div class="collapse" id="silvarplus">
                <div class="card card-body" style="color:black;">
                    Silver+ (If Team A Sales $30000.00 USD and Team B Sales $30000.00 total sales $60000.00 USD, You will
                    become Silver+ customer you will get India tours)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(171,149,33,1) 31%, rgba(25,19,0,1) 44%, rgba(113,99,51,1) 54%, rgba(140,167,97,1) 62%, rgba(160,146,98,1) 68%, rgba(102,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">

                <strong><a data-toggle="collapse" href="#gold" role="button" aria-expanded="false"
                        aria-controls="gold"><strong style="font-size: 24px;">Gold</strong></a></strong><br />


                @if ($gold_per > 0)
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $gold_per }}%"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($gold_per, 2) }}%
                        </div>
                    </div>
                    <p style="margin-top:5px;">Congratulations : {{ Auth::user()->name }} Best wishes from Like family for
                        achieving the rank. Earn next rank to get more opportunities to earn more Thanks.</p>
                @else
                    <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                    <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                        There are also various types of facilities</p>
                @endif

            </div>

            <div class="collapse" id="gold">
                <div class="card card-body" style="color:black;">
                    Gold (If Team A Sales $40000.00 USD and Team B Sales $40000.00 total sales $80000.00 USD, You will
                    become Gold customer you will get $200.00 USD 3 months)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(171,149,33,1) 31%, rgba(25,19,0,1) 44%, rgba(113,99,51,1) 54%, rgba(140,167,97,1) 62%, rgba(160,146,98,1) 68%, rgba(102,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">
                <strong> <a data-toggle="collapse" href="#gold_plus" role="button" aria-expanded="false"
                        aria-controls="gold_plus"><strong style="font-size: 24px;">Gold+</strong></a></strong><br />

                <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                    There are also various types of facilities</p>
            </div>

            <div class="collapse" id="gold_plus">
                <div class="card card-body" style="color:black;">
                    Gold+ (If Team A Sales $50,000.00 USD and Team B Sales $50,000.00 total sales $100,000.00 USD, You will
                    become Gold+ customer you will get nepal tour)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(171,149,33,1) 31%, rgba(25,19,0,1) 44%, rgba(228,179,14,1) 54%, rgba(140,167,97,1) 62%, rgba(160,146,98,1) 68%, rgba(102,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">
                <a data-toggle="collapse" href="#diamond" role="button" aria-expanded="false"
                    aria-controls="diamond"><strong style="font-size: 24px;">Diamond</strong></a><br />

                <strong style="font-size: 24px;"></strong><br />
                <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                    There are also various types of facilities</p>
            </div>

            <div class="collapse" id="diamond">
                <div class="card card-body" style="color:black;">
                    Daimond (If Team A Sales $60,000.00 USD and Team B Sales $60,000.00 total sales $120,000.00 USD, You
                    will become Daimond customer you will get $300 3 months)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(171,149,33,1) 31%, rgba(25,19,0,1) 44%, rgba(228,179,14,1) 54%, rgba(140,167,97,1) 62%, rgba(160,146,98,1) 68%, rgba(102,94,189,1) 73%, rgba(22,167,196,1) 95%);"
                align="center">

                <strong><a data-toggle="collapse" href="#diamond_plus" role="button" aria-expanded="false"
                        aria-controls="diamond_plus"><strong style="font-size: 24px;">Diamond+</strong></a></strong><br />
                <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                    There are also various types of facilities</p>
            </div>

            <div class="collapse" id="diamond_plus">
                <div class="card card-body" style="color:black;">
                    Daimond+ (If Team A Sales $70,000.00 USD and Team B Sales $70,000.00 total sales $140,000.00 USD, You
                    will become Daimond+ customer you will get Dubai tour)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(33,126,171,1) 31%, rgba(25,19,0,1) 44%, rgba(48,184,155,0.9948354341736695) 54%, rgba(105,194,183,1) 59%, rgba(140,167,97,1) 62%, rgba(135,195,111,1) 68%, rgba(196,159,22,1) 95%);"
                align="center">

                <strong><a data-toggle="collapse" href="#Platinum" role="button" aria-expanded="false"
                        aria-controls="Platinum"><strong style="font-size: 24px;">Platinum</strong></a></strong><br />
                <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                    There are also various types of facilities</p>
            </div>
            <div class="collapse" id="Platinum">
                <div class="card card-body" style="color:black;">
                    Platinum (If Team A Sales $80,000.00 USD and Team B Sales $80,000.00 total sales $160,000.00 USD, You
                    will become Platinum customer you will get $500 3 months)
                </div>
            </div>

            <div class="col-lg-12 rounded shadow-lg mt-3"
                style="height: 210px; padding:10px; background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 3%, rgba(1,0,17,1) 12%, rgba(38,57,194,1) 26%, rgba(33,126,171,1) 31%, rgba(25,19,0,1) 44%, rgba(48,184,155,0.9948354341736695) 54%, rgba(105,194,183,1) 59%, rgba(140,167,97,1) 62%, rgba(135,195,111,1) 68%, rgba(196,159,22,1) 95%);"
                align="center">

                <strong><a data-toggle="collapse" href="#Platinum_plus" role="button" aria-expanded="false"
                        aria-controls="Platinum_plus"><strong
                            style="font-size: 24px;">Platinu+</strong></a></strong><br />
                <i class="fas fa-lock fa-sm fa-fw fa-2x mr-2 text-gray-400"></i>
                <p style="font-size: 20px;">Use like regularly. There is royalty income only after achieving rank.
                    There are also various types of facilities</p>
            </div>
            <div class="collapse" id="Platinum_plus">
                <div class="card card-body" style="color:black;">
                    Platinum+ (If Team A Sales $100,000.00 USD and Team B Sales $100,000.00 total sales $200,000.00 USD, You
                    will become Platinum+ customer you will get Thailand tour)
                </div>
            </div>


        </div>
    </div>
@endsection
