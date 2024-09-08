@extends('users.master')
@section('title')
    <title>Deposit</title>
@endsection
@section('sub_title')
    Balance Deposit
@endsection
@section('maincontianer')
    <div class="container-fluid">
        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('deposit') }}">Deposit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('deposit-report') }}">Deposit Report</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ url('depositstore') }}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="card mb-2">
                        <div class="p-3">
                            Available Balance<br />
                            <span
                                style="font-weight: bold; color:green;">${{ number_format($userinfo->transfer_balance, 2) }}
                                USD</span>
                        </div>
                    </div>

                    @include('users.success')


                    <div class="form-group">
                        <table>
                            @foreach ($accounts as $item)
                                <tr>
                                    <td>
                                        <strong>Wallet name</strong> : {{ $item->accoount_name }}<br />
                                        <strong>Wallet Address : </strong><br />
                                        {{ $item->account_link }}<br />
                                        <a href="javascript:void(0)" data-address="{{ $item->account_link }}"
                                            class="btn btn-primary btn-sm withJquery">Copy</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Amount</label>
                        <input type="text" autocomplete="new-password"
                            class="form-control @if ($errors->has('amount')) is-invalid @endif" id="amount"
                            name="amount" />
                        @if ($errors->has('amount'))
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $errors->first('amount') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Upload Screenshot</label>
                        <input type="file" autocomplete="new-password"
                            class="form-control @if ($errors->has('uploadfile')) is-invalid @endif" id="uploadfile"
                            name="uploadfile" />
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
@section('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.withJquery', function() {
                const textToCopy = $(this).attr('data-address');
                navigator.clipboard.writeText(textToCopy);
                $(this).text('Copyed');
            });

        });
    </script>
@endsection
