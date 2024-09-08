@extends('users.master')
@section('title')
    <title>Transfer Report</title>
@endsection

@section('sub_title')
    Transfer Report
@endsection

@section('maincontianer')
    <div class="container-fluid mt-3">

        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('transfer-wallet') }}">Balance Transfer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('transfer-report') }}">Transfer Report</a>
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

                            $amount += $item->debit_amount;

                            if ($item->status == 'Success') {
                                $statusname = '<strong style="color:white;">Success</strong>';
                            } else {
                                $statusname = '<strong style="color:red;">Pending</strong>';
                            }
                        @endphp
                        <tr>
                            <td style="width: 70%">
                                {{ date('d-m-Y H:i A', strtotime($item->created_at)) }}<br />
                                {{ $item->note }}

                            </td>

                            <td>
                                ${{ number_format($item->debit_amount, 2) }}
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
