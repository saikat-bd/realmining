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
                    <a href="#">Add Group</a>
                </li>
            </ul><!-- /.breadcrumb -->

        </div>

        <div class="page-content">
            <div class="row">


                <h2>{{ $groupinfo->group_name }}</h2>

                <ul class="media-list">
                    @foreach ($groups as $item)
                        <li class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" style="width:40px;"
                                        src="{{ asset('public/logo/profile.webp') }}" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $item->name }}</h4>
                                {{ $item->message }}



                                @if ($item->reply)
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" style="width:40px;"
                                                    src="{{ asset('public/logo/profile.webp') }}" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $item->reply->name }}</h4>
                                            {{ $item->reply->message }}
                                        </div>
                                    </div>
                                @else
                                    <a href="javascript:void(0);" onClick="modelopen({{ $item->id }})">Reply</a>
                                @endif



                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="col-md-12">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/discussion/store') }}"
                        enctype="multipart/form-data">
                        <input type="hidden" name="group_id" value="{{ $groupinfo->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label>Message</label>
                        <textarea class="form-control" required name="message" placeholder="Comments here..."></textarea>
                        <div style="margin-top:10px;">
                            <button class="btn btn-sm btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div><!-- /.row -->

        </div><!-- /.page-content -->
    </div>

    <!-- Button trigger modal -->
    <form class="form-horizontal" method="POST" action="{{ url('admin/discussion/store') }}"
        enctype="multipart/form-data">
        <input type="hidden" name="group_id" value="{{ $groupinfo->id }}">
        <input type="hidden" name="pranent" id="pranent">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Reply</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" required name="message" placeholder="Comments here..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        function modelopen(id) {
            $('#pranent').val(id);
            $('#myModal').modal('show');
        }
    </script>


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
