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
                    <a href="#">Group Manages</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div>
                <a href="{{ url('admin/group/form') }}" class="btn btn-info btn-sm"><i class="fa glyphicon-plus fa-lg"></i>
                    New</a>
            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Group Name</th>
                        <th>Group Code</th>
                        <th>Members</th>
                        <th>Discussions</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td><a href="{{ url('admin/members?group_id=' . $v->id) }}">{{ $v->group_name }}</a></td>
                            <td>{{ $v->group_code }}</td>
                            <td><a href="{{ url('admin/members?group_id=' . $v->id) }}">{{ $v->members_count }}</a></td>
                            <td><a href="{{ url('admin/discussion/show/' . $v->id) }}">Message</a></td>
                            <td>{{ $v->note }}</td>
                            <td>
                                <a href="{{ url('admin/group/edit/' . $v->id) }}" class="btn btn-xs btn-info"><i
                                        class="ace-icon fa fa-pencil bigger-120"></i></a> <a
                                    onClick="return confirm('Are you sure delete this data?')"
                                    href="{{ url('admin/group/delete/' . $v->id) }}" class="btn btn-xs btn-danger"><i
                                        class="ace-icon fa fa-trash-o bigger-120"></i></a>

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
