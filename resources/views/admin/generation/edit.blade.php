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
                    <a href="#">Generation Edit</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">

                <form class="form-horizontal" method="POST"
                    action="{{ url('admin/settings/generation/update/' . $generation->id) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_1 }}" id="lavel_1"
                                name="lavel_1" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_2 }}" id="lavel_2"
                                name="lavel_2" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_3 }}" id="lavel_3"
                                name="lavel_3" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 4</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_4 }}" id="lavel_4"
                                name="lavel_4" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 5</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_5 }}" id="lavel_5"
                                name="lavel_5" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 6</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_6 }}" id="lavel_6"
                                name="lavel_6" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 7</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_7 }}" id="lavel_7"
                                name="lavel_7" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 8</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_8 }}" id="lavel_8"
                                name="lavel_8" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 9</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_9 }}" id="lavel_9"
                                name="lavel_9" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lavel - 10</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{ $generation->lavel_10 }}"
                                id="lavel_10" name="lavel_10" />
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
