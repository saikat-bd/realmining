@extends('admin.partial.master')

@section('title')
    <title>{{ $settings->company_name }}</title>
@endsection

@section('cssfile')
    <link rel="stylesheet" href="{{ asset('public/text_editor_sumnato/summernote.css') }}">
@endsection

@section('mainsection')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Wallet Account</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/settings/wallet-accounts/store') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">




                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Account Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="accoount_name" name="accoount_name" />
                            @if ($errors->has('accoount_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('accoount_name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Wallet Address</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="account_link" name="account_link" />
                            @if ($errors->has('account_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_link') }}
                                </div>
                            @endif
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
