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
                    <a href="#">Income Report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer/income-report') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 250px;">
                                <select class="form-control" name="package_id" id="package_id">
                                    <option value="">--Select--</option>

                                </select>
                            </td>

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
                        <th>Serial No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Member ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($transaction as $item)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username }}</td>
                            <td>${{ number_format($item->credit_amount, 2) }}</td>
                            <td>{{ date('d-m-Y g:i A', strtotime($item->created_at)) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div>
                {{ $transaction->links('pagination::bootstrap-4') }}

            </div>

        </div><!-- /.page-content -->
    </div>
@endsection
