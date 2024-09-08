@extends('users.master')
@section('title')
    <title>Withdrawal Report</title>
@endsection

@section('sub_title')
    {{ $subtitle }}
@endsection

@section('maincontianer')
    <div class="container-fluid" style="color:white;">
        <div class="row">
            <h2>{{ $subtitle }}</h2>
            <table class="table table-bordered table-sm" style="color:white;">
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

                            if ($item->status == 'Success') {
                                $statusname = '<strong style="color:white;">Success</strong>';
                            } else {
                                $statusname = '<strong style="color:red;">Pending</strong>';
                            }
                        @endphp
                        <tr>
                            <td style="width: 70%">{{ date('d-m-Y H:i A', strtotime($item->created_at)) }}<br />
                                {{ $item->status }}

                            </td>

                            <td>
                                ${{ number_format($item->amount, 2) }}
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

            <div class="d-felx justify-content-center">

                {{ $history->links('pagination::bootstrap-4') }}

            </div>
        </div>

    </div>
@endsection
