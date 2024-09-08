@extends('users.master')
@section('title')
    <title>Earning History</title>
@endsection

@section('sub_title')
    {{ $subtitle }}
@endsection

@section('maincontianer')
    <div class="container-fluid">
        <div class="row">


            <form class="col-md-12" action="{{ url('history') }}" method="get">

                <div class="row mb-2">
                    <div class="col-5 row">
                        <select class="form-control" name="tran_type" id="tran_type">
                            <option value="">--Select--</option>
                            <option value="admin" @if (Request::get('tran_type') == 'admin') selected @endif>Received Admin</option>
                            <option value="user" @if (Request::get('tran_type') == 'user') selected @endif>Received User</option>
                            <option value="transfer" @if (Request::get('tran_type') == 'transfer') selected @endif>Transfer To User
                            </option>
                            <option value="purchase" @if (Request::get('tran_type') == 'purchase') selected @endif>Investment</option>
                            <option value="exclusive" @if (Request::get('tran_type') == 'exclusive') selected @endif>Exclusive Plus
                            </option>
                            <option value="withdrawal" @if (Request::get('tran_type') == 'withdrawal') selected @endif>Withdrawal</option>
                            <option value="Generation" @if (Request::get('tran_type') == 'Generation') selected @endif>Generation</option>
                            <option value="daily" @if (Request::get('tran_type') == 'daily') selected @endif>Daily</option>
                            <option value="rank" @if (Request::get('tran_type') == 'rank') selected @endif>Incentive</option>

                        </select>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" value="{{ Request::get('search') }}" name="search"
                            placeholder="Enter search" />
                    </div>

                    <div class="col-2">
                        <th><button class="btn btn-primary">Search</button></th>
                    </div>
                </div>
            </form>


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
                        $credit_amount = 0;
                        $debit_amount = 0;
                    @endphp
                    @foreach ($history as $item)
                        @php
                            $credit_amount += $item->credit_amount;
                            $debit_amount += $item->debit_amount;

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
                        <td style="text-align: right;">Balance</td>
                        <td>
                            @if ($credit_amount > $debit_amount)
                                ${{ number_format($credit_amount - $debit_amount, 2) }}
                            @else
                                ${{ number_format($debit_amount - $credit_amount, 2) }}
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
