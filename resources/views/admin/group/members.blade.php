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
                    <a href="#">Group Members</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">

            <div>
                <form action="{{ url('admin/members') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 250px;">
                                <select name="group_id" id="" class="form-control">
                                    <option value="0">--Group Name--</option>
                                    @foreach ($groups as $item)
                                        <option value="{{ $item->id }}"
                                            @if (Request::get('group_id') == $item->id) selected @endif>
                                            {{ $item->group_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 250px;">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                    placeholder="User name search..." class="form-control">
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
                        <th>User Name</th>
                        <th>Group Name</th>
                        <th>Group Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gorupmembers as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->group_name }}</td>
                            <td>{{ $v->group_code }}</td>
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
