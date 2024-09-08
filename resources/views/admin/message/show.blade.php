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
                    <a href="#">Show</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <h5>ID : {{ $messages->user_id }}</h5>
            <h5>From : {{ $messages->name }}</h5>
            <p>{{ $messages->messages }}</p>
            @if ($messages->attachment)
                <a target="_blank" href="{{ asset('public/messages/' . $messages->attachment) }}">Attachment Download</a>
            @endif



            <div style="margin-top:20px;">
                <form method="post" action="{{ url('admin/message/reply') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $messages->id }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reply</label>
                        <textarea name="messages" id="messages" required class="form-control" cols="30" rows="10"></textarea>
                        @if ($errors->has('messages'))
                            <div class="invalid-feedback">
                                {{ $errors->first('messages') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Attachment</label>
                        <input type="file" name="uploadfile" id="uploadfile" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
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
