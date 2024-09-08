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
                    <a href="#">Exclusive Plan Manages</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div class="">
                <a href="{{ url('admin/settings/exclusive-manage/form') }}" class="btn btn-info btn-sm"><i
                        class="fa glyphicon-plus fa-lg"></i>
                    New</a>
            </div>

            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Plan Name</th>
                        <th>Plan Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exlusives as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->plan_name }}</td>
                            <td>$ {{ $v->plan_amount }}</td>

                            <td>{!! $v->description !!}</td>

                            <td>
                                <a href="{{ url('admin/settings/exclusive-manage/edit/' . $v->id) }}"
                                    class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>

                            </td>
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
