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
                    <a href="#">Investment Report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer/invstment-report') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 250px;">
                                <select class="form-control" name="package_id" id="package_id">
                                    <option value="">--Select Package--</option>
                                    @foreach ($packages as $item)
                                        <option value="{{ $item->id }}"
                                            @if (Request::get('package_id') == $item->id) selected @endif>
                                            {{ $item->package_name }}</option>
                                    @endforeach


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
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Member ID</th>
                        <th>Package</th>
                        <th>Amount</th>
                        <th>P.D Income</th>
                        <th>Remaining</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Last Rebite time</th>
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
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->package_name }}</td>
                            <td>${{ number_format($item->invest_amount, 2) }}</td>
                            <td>${{ $item->daily_rabit }}</td>
                            <td>{{ $item->days }} days</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ date('g:i A', strtotime($item->invest_time)) }}</td>
                            <td>{{ date('d-m-Y g:i A', strtotime($item->updated_at)) }}</td>
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
