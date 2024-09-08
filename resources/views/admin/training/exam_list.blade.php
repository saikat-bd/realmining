@extends('admin.partial.master')

@section('title')
    <title>{{ $settings->company_name }}</title>
@endsection

@section('cssfile')
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap-datepicker3.min.css') }}" />
@endsection

@section('mainsection')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Courses</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div>
                <form action="{{ url('admin/training') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 350px;">
                                <select name="course_id" id="" class="form-control">
                                    <option value="0">--Courses--</option>
                                    @foreach ($courselist as $item)
                                        <option value="{{ $item->id }}"
                                            @if (Request::get('course_id') == $item->id) selected @endif>{{ $item->course_title }}
                                        </option>
                                    @endforeach



                                </select>
                            </td>
                            <td style="width: 250px;">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                    placeholder="Enter..." class="form-control">
                            </td>

                            <td style="width: 250px;">
                                <input type="text" name="form_date" value="{{ Request::get('form_date') }}"
                                    placeholder="From Date" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    autocomplete="off">
                            </td>

                            <td style="width: 250px;">
                                <input type="text" name="to_date" value="{{ Request::get('to_date') }}"
                                    placeholder="To Date" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    autocomplete="off">
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
                        <th>Date</th>
                        <th>Coures Name</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Total question</th>
                        <th>Passed Mark</th>
                        <th>Answer Mark</th>
                        <th>Score</th>
                        <th>Status</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($examlist as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ date('d-m-Y', strtotime($v->created_at)) }}</td>
                            <td><a target="_blank"
                                    href="{{ url('admin/training/certificate/' . $v->id) }}">{{ $v->course_title }}</a>
                            </td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->username }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->total_question }}</td>
                            <td>{{ $v->pass_mask }}</td>
                            <td>{{ $v->ansmarks }}</td>
                            <td>{{ $v->final_score }}%</td>
                            <td>
                                @if ($v->pass_status == 'Passed')
                                    <span class="label label-sm label-success"> {{ $v->pass_status }}</span>
                                @elseif($v->pass_status == 'Failed')
                                    <span class="label label-sm label-danger"> {{ $v->pass_status }}</span>
                                @else
                                    <span class="label label-sm label-warning">Continue</span>
                                @endif


                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

            <div>
                {{ $examlist->links() }}
            </div>

        </div><!-- /.page-content -->
    </div>
@endsection


@section('javascript')
    <script src="{{ asset('public/admin/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>

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
