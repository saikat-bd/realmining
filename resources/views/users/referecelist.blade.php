@extends('users.master')
@section('title')
    <title>My Team</title>
@endsection
@section('sub_title')
    My Reference
@endsection
@section('maincontianer')
    <div class="container-fluid">


        <div class="row">

            <div class="col-lg-12">
                <form action="{{ url('my-refrences') }}" method="get">
                    <input type="hidden" value="{{ Request::get('user_id') }}" name="user_id">
                    <div class="row mb-2">
                        <div class="col-9">
                            <select class="form-control" name="gen_type" id="gen_type">
                                <option value="">--Select--</option>
                                <option value="1" @if (Request::get('gen_type') == 1) selected @endif>1st Gen </option>
                                <option value="2" @if (Request::get('gen_type') == 2) selected @endif>2nd Gen</option>
                                <option value="3" @if (Request::get('gen_type') == 3) selected @endif>3rd Gen</option>
                                <option value="4" @if (Request::get('gen_type') == 4) selected @endif>4th Gen</option>
                                <option value="5" @if (Request::get('gen_type') == 5) selected @endif>5th Gen</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <th><button class="btn btn-primary">Search</button></th>
                        </div>
                    </div>
                </form>
                @if (Request::get('gen_type'))
                    <div class="mb-2">
                        Investment ${{ number_format($secendgen_amount, 2) }}
                    </div>
                @endif



                <table class="table table-bordered" style="color:white;">
                    <thead>

                        <tr>
                            <th>SL</th>
                            <th>Usename</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                            $postion = '';
                        @endphp
                        @foreach ($userlist as $item)
                            @if ($item->position == 1)
                                @php
                                    $postion = '1st Gen';
                                @endphp
                            @elseif($item->position == 2)
                                @php
                                    $postion = '2nd Gen';
                                @endphp
                            @elseif($item->position == 3)
                                @php
                                    $postion = '3rd Gen';
                                @endphp
                            @elseif($item->position == 4)
                                @php
                                    $postion = '4th Gen';
                                @endphp
                            @elseif($item->position == 5)
                                @php
                                    $postion = '5th Gen';
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td><a href="{{ url('my-refrences?user_id=' . $item->user_id) }}">{{ $item->username }}</a>
                                </td>
                                <td>{{ date('d/m/y h:i A', strtotime($item->created_at)) }}</td>
                                <td>{{ $postion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
