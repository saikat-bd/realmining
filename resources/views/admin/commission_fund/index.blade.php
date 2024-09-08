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
                    <a href="#">Fund Statement</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div class="">
                <a href="{{ url('admin/settings/packagemanage/form') }}" class="btn btn-info btn-sm"><i
                        class="fa glyphicon-plus fa-lg"></i>
                    New</a>
            </div>

            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balance = 0;
                    @endphp
                    @foreach ($statment as $v)
                        @php
                            $balance += $v->amount;
                        @endphp
                        <tr>
                            <td>#{{ $v->id }}</td>

                            <td>{{ $v->note }}</td>
                            <td>{{ $v->created_at }}</td>
                            <td>$ {{ $v->amount }}</td>
                            <td>{{ $v->name }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" align="right"><strong>Total Balance</strong></td>
                        <td><strong>${{ number_format($balance, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div>
                {{ $statment->links('pagination::bootstrap-4') }}
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
