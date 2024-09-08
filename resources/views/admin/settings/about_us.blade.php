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
                    <a href="#">About US</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/settings/about-us') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">About Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="about_title" name="about_title"
                                value="{{ $setting->about_title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">About US</label>
                        <div class="col-sm-8">
                            <textarea rows="6" name="about_us" id="write-content" class="form-control">{{ $setting->about_us }}</textarea>
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
    <script type="text/javascript" src="{{ asset('public/text_editor_sumnato/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/text_editor_sumnato/wp.js') }}"></script>
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
