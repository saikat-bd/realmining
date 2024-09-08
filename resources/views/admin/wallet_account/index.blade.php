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
                    <a href="#">Wallet Accounts</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">
            <div class="">
                <a href="{{ url('admin/settings/wallet-accounts/form') }}" class="btn btn-info btn-sm"><i
                        class="fa glyphicon-plus fa-lg"></i>
                    New</a>
            </div>

            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Account Name</th>
                        <th>Wallet Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packagte as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->accoount_name }}</td>
                            <td>${{ $v->account_link }}</td>

                            <td>
                                <a href="{{ url('admin/settings/wallet-accounts/edit/' . $v->id) }}"
                                    class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>

                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

            <div>
                {{ $packagte->links('pagination::bootstrap-4') }}
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
