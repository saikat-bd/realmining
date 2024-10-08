@extends('users.master')
@section('title')
    <title>Withdrawal</title>
@endsection
@section('sub_title')
    withdrawal
@endsection
@section('style')
@endsection

@section('maincontianer')
    <div class="container-fluid">


        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('debit-to-withdrawal') }}">Withdrawal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('withdrawal-report') }}">Withdrawal Report</a>
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
                    @foreach ($widthrawal as $item)
                        @php

                            $amount += $item->amount;

                            if ($item->status == 'Paid') {
                                $statusname = '<strong style="color:green;">Success</strong>';
                            } else {
                                $statusname = '<strong style="color:red;">Pending</strong>';
                            }
                        @endphp
                        <tr>
                            <td style="width: 70%">
                                {{ date('d-m-Y H:i A', strtotime($item->created_at)) }}<br />
                                {{ $item->account_name }}<br />
                                {{ $item->binance_id }}

                            </td>

                            <td>
                                ${{ number_format($item->amount, 2) }} <br />
                                {!! $statusname !!}
                            </td>


                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: right;">Total </td>
                        <td>
                            ${{ number_format($amount, 2) }}

                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>


    </div>
@endsection

@section('script')
@endsection
