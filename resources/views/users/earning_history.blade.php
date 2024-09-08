@extends('users.master')
@section('title')
    <title>Like-Debit Earning History</title>
@endsection
@section('sub_title')
    Earning History
@endsection
@section('maincontianer')
    <div class="container-fluid">


        <div class="row">
            <table class="table table-bordered table-sm" style="color:white;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Note</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalamount = 0;
                    @endphp
                    @foreach ($totalincome as $item)
                        @php
                            $totalamount += $item->credit_amount;
                        @endphp
                        <tr>
                            <td>{{ $item->tran_date }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ number_format($item->credit_amount, 2) }}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total Earning</td>
                        <td>${{ number_format($totalamount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>
@endsection
