@extends('users.master')
@section('title')
    <title>My Team</title>
@endsection
@section('sub_title')
    My Reference
@endsection
@section('maincontianer')
    <div class="container-fluid">
        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('invite-link') }}">Invite Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('my-refrences') }}">My Reference</a>
                </li>

            </ul>
        </div>


        <div class="row">

            <div class="col-lg-12">

                <table class="table table-bordered">
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
