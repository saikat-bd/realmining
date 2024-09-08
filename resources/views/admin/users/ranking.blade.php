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
                    <a href="#">Member Rank</a>
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
                        <th>Title</th>
                        <th>Insentive</th>
                        <th>Monthly Salary</th>
                        <th>Rank date</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($usernaks as $v)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->username }}</td>
                            <td>{{ $v->rank_name }}</td>
                            <td>{{ $v->insentive_amount }}</td>
                            <td>{{ $v->monthly_amount }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($v->updated_at)) }}</td>


                        </tr>
                    @endforeach



                </tbody>
            </table>



        </div><!-- /.page-content -->
    </div>
@endsection
