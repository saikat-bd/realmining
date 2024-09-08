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
                    <a href="#">Exclusive Plan</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/settings/exclusive-manage/store') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">




                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Plan Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="plan_name" name="plan_name" />
                            @if ($errors->has('plan_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plan_name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Plan Price</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="plan_amount" name="plan_amount" />
                            @if ($errors->has('plan_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plan_amount') }}
                                </div>
                            @endif
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" id="write-content" class="form-control" rows="3"></textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
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
