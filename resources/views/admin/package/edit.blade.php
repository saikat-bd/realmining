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
                    <a href="#">Package Edit</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST"
                    action="{{ url('admin/settings/packagemanage/update/' . $datainfo->id) }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Package Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $datainfo->package_name }}"
                                id="package_name" name="package_name" />
                            @if ($errors->has('package_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('package_name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Package Price</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $datainfo->amount }}" id="amount"
                                name="amount" />
                            @if ($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Day Income</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $datainfo->rabit }}" id="rabit"
                                name="rabit" />
                            @if ($errors->has('rabit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rabit') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Duraction</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $datainfo->duraction }}" id="duraction"
                                name="duraction" />
                            @if ($errors->has('duraction'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('duraction') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Total Income</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="total_amount"
                                value="{{ $datainfo->total_amount }}" name="total_amount" />
                            @if ($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
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
