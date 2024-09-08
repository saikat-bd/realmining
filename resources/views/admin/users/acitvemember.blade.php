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
                    <a href="#">Active Member</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">

            <div>
                <form action="{{ url('admin/customer/activemember') }}" method="get">
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Sponser Info</th>
                        <th>E-mail</th>
                        <th>Mobile Number</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Balance</th>
                        <th>Lock Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $v)
                        @php
                            if ($v->status == 'Active') {
                                $color = 'green';
                            } else {
                                $color = 'red';
                            }

                            if ($v->payment_lock == 'Active') {
                                $pcolor = 'green';
                            } else {
                                $pcolor = 'red';
                            }

                        @endphp
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td><a target="_blank"
                                    href="{{ url('admin/customer/custoermlogin/' . $v->id) }}">{{ $v->username }} </a>
                            </td>
                            <td>
                                @if ($v->referinfo)
                                    Username : {{ $v->referinfo->username }} <br />
                                    ID : {{ $v->referinfo->id }} <br />
                                @endif


                            </td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->phone_number }}</td>
                            <td>{{ $v->gender }}</td>
                            <td>{{ $v->created_at }}</td>
                            <td>{{ $v->user_type }}</td>
                            <td>

                                <span style="color:{{ $color }}">{{ $v->status }}</span>

                            </td>
                            <td><span
                                    style="color:green; font-size:16px;">${{ number_format($v->transfer_balance, 2) }}</span>
                            </td>
                            <td>

                                <span style="color:{{ $pcolor }}">{{ $v->payment_lock }}</span>

                            </td>
                            <td><a href="{{ url('admin/customer/edit/' . $v->id) }}">Edit</a></td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

            <div>
                {{ $users->links('pagination::bootstrap-4') }}
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
