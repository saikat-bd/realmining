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
                    <a href="#">Exclusive report</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">


            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($exlusives as $v)
                        <tr>
                            <td>#{{ $sl++ }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->username }}</td>
                            <td>${{ $v->buy_amount }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($v->created_at)) }}</td>


                        </tr>
                    @endforeach



                </tbody>
            </table>



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
