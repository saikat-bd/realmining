@extends('admin.partial.master')

@section('title')
    <title>{{ $settings->company_name }}</title>
@endsection

@section('mainsection')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Withdrawal</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer/withdrawal-report') }}" method="get">
                    <table>
                        <tr>

                            <td style="width: 250px;">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                    placeholder="Email, Name..." class="form-control">
                            </td>
                            <td>&nbsp; From Date &nbsp;</td>
                            <td style="width: 250px;">
                                <input type="date" name="form_date" value="{{ Request::get('form_date') }}"
                                    placeholder="Form Date" class="form-control">
                            </td>

                            <td>&nbsp; To Date &nbsp;</td>
                            <td style="width: 250px;">
                                <input type="date" name="to_date" value="{{ Request::get('to_date') }}"
                                    class="form-control">
                            </td>

                            <td><button type="submit" class="btn btn-success btn-sm">Search</button></td>
                        </tr>
                    </table>
                </form>
            </div>


            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Account Name</th>
                        <th>Wallet Address</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdrawal as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->account_name }}</td>
                            <td>{{ $item->binance_id }}</td>
                            <td>${{ number_format($item->amount, 2) }}</td>
                            <td>{{ $item->withdawal_date }}</td>
                            <td>
                                <span style="color:green">{{ $item->status }}</span>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div>
                {{ $withdrawal->links('pagination::bootstrap-4') }}

            </div>

        </div><!-- /.page-content -->
    </div>
@endsection
