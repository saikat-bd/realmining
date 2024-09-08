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
                    <a href="#">Logo Upload</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/settings/logo') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Logo Upload</label>
                        <div class="col-sm-4">
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <img style="width: 80px;" src="{{ asset('public/logo/' . $setting->logo) }}" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Favicon Upload</label>
                        <div class="col-sm-4">
                            <input type="file" name="favicon" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <img style="width: 80px;" src="{{ asset('public/logo/' . $setting->favicon) }}" alt="">
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
