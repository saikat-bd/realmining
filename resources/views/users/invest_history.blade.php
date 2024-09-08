@extends('users.master')
@section('title')
    <title>Investment</title>
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
                        $debit_amount = 0;
                        $credit_amount = 0;
                    @endphp
                    @foreach ($history as $item)
                        @php

                            $debit_amount += $item->debit_amount;
                            $credit_amount += $item->credit_amount;

                            if ($item->withdraw_status == 'Success') {
                                $statusname = '<strong style="color:white;">Success</strong>';
                            } else {
                                $statusname = '<strong style="color:red;">Pending</strong>';
                            }
                        @endphp
                        <tr>
                            <td style="width: 70%">{{ date('d-m-Y H:i A', strtotime($item->created_at)) }}<br />
                                {{ $item->note }}<br />
                                {!! $statusname !!}
                            </td>

                            <td>Credit ${{ number_format($item->credit_amount, 2) }} <br />
                                Debit ${{ number_format($item->debit_amount, 2) }}
                            </td>


                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: right;">Total </td>
                        <td>
                            @if ($credit_amount > 0)
                                ${{ number_format($credit_amount - $debit_amount, 2) }}
                            @else
                                ${{ number_format($debit_amount, 2) }}
                            @endif



                        </td>
                    </tr>
                </tfoot>

            </table>

            <div class="row" style="font-size: 8px;">

                {{ $history->links('pagination::bootstrap-4') }}

            </div>
        </div>

    </div>
@endsection
