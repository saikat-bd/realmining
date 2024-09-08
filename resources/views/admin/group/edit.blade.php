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
                    <a href="#">Edit Group</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST" action="{{ url('admin/group/update/' . $groupinfo->id) }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Group Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="group_name"
                                value="{{ old('group_name', $groupinfo->group_name) }}" name="group_name" />
                            @if ($errors->has('group_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('group_name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Group Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="group_code"
                                value="{{ old('group_code', $groupinfo->group_code) }}" name="group_code" />
                            @if ($errors->has('group_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('group_code') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Note</label>
                        <div class="col-sm-4">
                            <textarea name="note" id="note" class="form-control" cols="30" rows="4">{{ $groupinfo->note }}</textarea>
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
