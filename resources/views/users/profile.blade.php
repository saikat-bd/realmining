@extends('users.master')
@section('title')
    <title>Like-Profile View</title>
@endsection
@section('sub_title')
    Profile
@endsection
@section('maincontianer')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <form action="{{ url('profile-update') }}" method="post">
                    <h2>Profile <a href="{{ url('profile-edit') }}" class="btn btn-primary btn-sm">Edit</a></h2>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @include('users.success')
                    @if ($userinfo->photo)
                        <div class="form-group">
                            <label for="formGroupExampleInput">Photo</label><br />
                            <img class="rounded img-fluid" style="height:220px; width:220px;"
                                src="{{ asset('public/photo/' . $userinfo->photo) }}" alt="{{ $userinfo->name }}">
                        </div>
                    @endif





                    <div class="form-group">
                        <label for="formGroupExampleInput">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="{{ $userinfo->first_name }}" />

                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ $userinfo->last_name }}" />
                    </div>


                    <div class="form-group">
                        <label for="formGroupExampleInput">Primary Email</label>
                        <input type="text" class="form-control" id="email" value="{{ $userinfo->email }}" readonly
                            name="email" />
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Country</label>
                        <select name="country_id" disabled id="country_id" class="form-control">
                            <option value="">--Select--</option>
                            @foreach ($countrys as $item)
                                <option value="{{ $item->id }}" @if ($userinfo->country_id == $item->id) selected @endif>
                                    {{ $item->country_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" readonly
                            value="{{ $userinfo->phone_number }}" />
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Gender</label>
                        <select name="gender" id="gender"
                            class="form-control @if ($errors->has('gender')) is-invalid @endif">
                            <option value="">--Select--</option>
                            <option value="Male" @if ($userinfo->gender == 'Male') selected @endif>
                                Male</option>
                            <option value="Female" @if ($userinfo->gender == 'Female') selected @endif>
                                Female</option>
                            <option value="Others" @if ($userinfo->gender == 'Others') selected @endif>
                                Others</option>
                        </select>
                        @if ($errors->has('gender'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="formGroupExampleInput">Account Status</label>
                        <input type="text" class="form-control" readonly value="{{ $userinfo->status }}" />
                    </div>



                </form>
            </div>


        </div>
    </div>
@endsection
