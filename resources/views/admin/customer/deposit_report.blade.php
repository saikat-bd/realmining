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
                    <a href="#">Deposit Report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer/deposit-report') }}" method="get">
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Amount</th>
                        <th>Screenshot</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdrawal as $item)
                        @if ($item->deposit_status == 'Paid')
                            @php
                                $color = 'green';
                            @endphp
                        @else
                            @php
                                $color = 'red';
                            @endphp
                        @endif
                        <tr>
                            <td>{{ $item->user_id }}</td>

                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->wallet_address }}</td>
                            <td>${{ number_format($item->amount, 2) }}</td>
                            <td>
                                <a target="_blank" href="{{ asset('public/screenshot/' . $item->fileupload) }}"><img
                                        src="{{ asset('public/screenshot/' . $item->fileupload) }}" height="50"></a>
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <span style="color:{{ $color }}">{{ $item->deposit_status }}</span>
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
