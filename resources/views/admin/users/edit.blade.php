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
                    <a href="#">Member Edit</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/customer/update/' . $datainfo->id) }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly value="{{ $datainfo->id }}" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly value="{{ $datainfo->name }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="new_password" name="new_password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Transaction PIN</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="transactionpin"
                                value="{{ $datainfo->transactionpin }}" name="transactionpin" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Current Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $datainfo->email }}" readonly
                                id="current_email" name="current_email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Change Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="change_email" name="change_email" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Transaction Lock Status</label>
                        <div class="col-sm-4">
                            <select name="payment_lock" class="form-control" id="payment_lock">
                                <option value="Active" @if ($datainfo->payment_lock == 'Active') selected @endif>Active</option>
                                <option value="Inactive" @if ($datainfo->payment_lock == 'Inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>






                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>


            </div><!-- /.row -->

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
@endsection
