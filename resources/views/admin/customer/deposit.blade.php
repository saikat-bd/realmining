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
                    <a href="#">Deposit List</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">



            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Screenshot</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deposits as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->wallet_address }}</td>
                            <td>
                                <a target="_blank" href="{{ asset('public/screenshot/' . $item->fileupload) }}"><img
                                        src="{{ asset('public/screenshot/' . $item->fileupload) }}" height="50"></a>
                            </td>

                            <td>${{ number_format($item->amount, 2) }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <span style="color:orange">{{ $item->deposit_status }}</span>
                            </td>
                            <td>
                                <a href="{{ url('admin/customer/deposit-paid/' . $item->id) }}">Paid</a> |
                                <a href="{{ url('admin/customer/deposit-rejected/' . $item->id) }}">Rejected</a>
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
@endsection
