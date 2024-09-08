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
                    <a href="#">Meta Data</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/settings/homecontent') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Home Description</label>
                        <div class="col-sm-8">
                            <textarea rows="6" name="home_content" id="write-content" class="form-control">{{ $setting->home_content }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Home Page Image</label>
                        <div class="col-sm-4">
                            <input type="file" name="home_image" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <img style="width: 80px;" src="{{ asset('public/images/' . $setting->home_image) }}"
                                alt="">
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
