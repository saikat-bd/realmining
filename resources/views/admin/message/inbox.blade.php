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
                    <a href="#">Inbox</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Messages</th>
                        <th>File Download</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                        <tr @if ($item->status == 0) style="background: #ACACAC;" @endif>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                            <td>{{ $item->messages }}</td>
                            <td>
                                @if ($item->attachment)
                                    <a target="_blank" href="{{ asset('public/messages/' . $item->attachment) }}">Attachment
                                        Download</a>
                                @endif
                            </td>
                            <td>
                                @if ($item->parent_id == null)
                                    <a href="{{ url('admin/message/show/' . $item->id) }}"><i
                                            class="fa fa-repeat fa-lg"></i></a>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $messages->links('pagination::bootstrap-4') }}
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
                title: 'Reply send success!',
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
