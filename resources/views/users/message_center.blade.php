@extends('users.master')
@section('title')
    <title>Like-Help Center</title>
@endsection
@section('sub_title')
    Help Center
@endsection
@section('maincontianer')
    <div class="container-fluid">


        <div class="row">

            <div class="col-lg-12">
                <form action="{{ url('sendmessage') }}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @include('users.success')

                    <div class="form-group">
                        <table>
                            @foreach ($messages as $item)
                                <tr>
                                    <td style="color:white;">
                                        {{ $item->messages }}<br />
                                        @if ($item->attachment)
                                            <a target="_blank" href="{{ asset('public/messages/' . $item->attachment) }}"
                                                style="color:white;">Attachment click</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Message</label>
                        <textarea name="message" id="message" class="form-control @if ($errors->has('message')) is-invalid @endif"
                            cols="30" rows="10" required placeholder="Write here..."></textarea>
                        @if ($errors->has('message'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('message') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Attachment</label>
                        <input type="file" class="form-control @if ($errors->has('uploadfile')) is-invalid @endif"
                            id="uploadfile" name="uploadfile" />
                        @if ($errors->has('uploadfile'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('uploadfile') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
            </div>
        </div>


    </div>
@endsection
