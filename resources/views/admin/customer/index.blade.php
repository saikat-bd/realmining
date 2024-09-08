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
                    <a href="#">Courses</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div>
                <form action="{{ url('admin/customer') }}" method="get">
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <select name="search_type" id="" class="form-control">
                                    <option value="0">--Type--</option>
                                    <option value="1" @if (Request::get('search_type') == 1) selected @endif>Username
                                    </option>
                                    <option value="2" @if (Request::get('search_type') == 2) selected @endif>Name</option>
                                    <option value="3" @if (Request::get('search_type') == 3) selected @endif>Phone</option>
                                    <option value="4" @if (Request::get('search_type') == 4) selected @endif>Email</option>
                                </select>
                            </td>
                            <td style="width: 250px;">
                                <input type="text" name="search" value="{{ Request::get('search') }}"
                                    placeholder="Enter..." class="form-control">
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
                        <th>Username</th>
                        <th>Employee name</th>
                        <th>E-mail</th>
                        <th>Phone Number</th>
                        <th>Photo</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->username }}</td>
                            <td>{{ $v->employee_name }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->phone_number }}</td>

                            <td>
                                <img style="height:60px;" src="{{ asset('public/images/' . $v->photo) }}" alt="">
                            </td>
                            <td>{{ $v->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-info"><i
                                        class="ace-icon fa fa-pencil bigger-120"></i></a> <a
                                    onClick="return confirm('Are you sure delete this data?')" href="#"
                                    class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>

                            </td>
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
@endsection
