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
                    <a href="#">Withdrawal Report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div>
                <form action="{{ url('admin/customer/withdrawal') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 250px;">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                    placeholder="ID,Email, Name..." class="form-control">
                            </td>
                            <td>&nbsp; From Date &nbsp;</td>
                            <td style="width: 250px;">
                                <input type="text" name="form_date" data-date-format="dd-mm-yyyy"
                                    value="{{ Request::get('form_date') }}" autocomplete="off" placeholder="dd-mm-yyyy"
                                    class="form-control date-picker">
                            </td>

                            <td>&nbsp; To Date &nbsp;</td>
                            <td style="width: 250px;">
                                <input type="text" name="to_date" data-date-format="dd-mm-yyyy"
                                    value="{{ Request::get('to_date') }}" autocomplete="off"
                                    class="form-control date-picker" placeholder="dd-mm-yyyy">
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
                        <th>Action</th>
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
                                <span style="color:orange">{{ $item->status }}</span>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ url('admin/customer/withdrawal-paid/' . $item->id) }}">Paid</a> <a
                                    href="{{ url('admin/customer/withdrawal-reject/' . $item->id) }}"
                                    class="btn btn-sm btn-danger">Reject</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div>


            </div>

        </div><!-- /.page-content -->
    </div>
@endsection


@section('javascript')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (Session::has('delete'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been deleted',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif


    <script src="{{ asset('public/admin/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection
@section('cssfile')
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap-datepicker3.min.css') }}" />
@endsection
