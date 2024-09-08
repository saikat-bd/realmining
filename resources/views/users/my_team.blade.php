@extends('users.master')
@section('title')
    <title>Like- My Team</title>
@endsection
@section('sub_title')
    My Team
@endsection
@section('maincontianer')
    <div class="container-fluid">


        <div class="row">



            <div class="col-lg-12">
                <div>
                    Team A : ${{ number_format($userinfo->left_point, 2) }} Team B :
                    ${{ number_format($userinfo->right_point, 2) }}
                </div>
                @php
                    $position = Request::get('position');
                    if ($position == 'left') {
                        $leftbuton = 'btn-success';
                        $rightbutton = 'btn-primary';
                    } else {
                        $rightbutton = 'btn-success';
                        $leftbuton = 'btn-primary';
                    }
                    
                @endphp
                <div>
                    <a href="{{ url('my-team?position=left') }}" class="btn {{ $leftbuton }}">Team A</a>
                    <a href="{{ url('my-team?position=right') }}" class="btn {{ $rightbutton }}">Team B</a>
                </div>


                <table class="table table-bordered" style="color:white;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usename</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userslist as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
