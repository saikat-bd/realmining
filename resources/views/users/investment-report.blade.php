@extends('users.master')
@section('title')
    <title>investment Report</title>
@endsection

@section('sub_title')
    investment Report
@endsection

@section('maincontianer')
    <div class="container-fluid ">
        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('investment') }}">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('investment-report') }}">Package Report</a>
                </li>

            </ul>
        </div>
        <div class="row">

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balance = 0;
                        $amount = 0;
                        $credit_amount = 0;
                    @endphp
                    @foreach ($history as $item)
                        @php

                            $amount += $item->amount;

                        @endphp
                        <tr>
                            <td style="width: 70%">
                                {{ $item->package_name }}<br />
                                {{ date('d-m-Y H:i A', strtotime($item->created_at)) }}

                            </td>

                            <td>
                                ${{ number_format($item->invest_amount, 2) }}<br />
                                Rebit ${{ number_format($item->daily_rabit, 2) }}
                            </td>


                        </tr>
                    @endforeach

                </tbody>


            </table>


        </div>

    </div>
@endsection
