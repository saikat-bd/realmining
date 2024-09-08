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
                    <a href="#">Vat/Tax Report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer/tax-report') }}" method="get">
                    <table>
                        <tr>

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
                        <th>Tax Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balance = 0;
                    @endphp
                    @foreach ($withdrawal as $item)
                        @php
                            $balance += $item->credit_amount;
                        @endphp
                        <tr>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>${{ number_format($item->credit_amount, 2) }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right"><strong>Total</strong></td>
                        <td>${{ number_format($balance, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            <div>
                {{ $withdrawal->links('pagination::bootstrap-4') }}

            </div>

        </div><!-- /.page-content -->
    </div>
@endsection
