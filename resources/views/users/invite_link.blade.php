@extends('users.master')
@section('title')
    <title>Invite linl</title>
@endsection
@section('sub_title')
    Invite Link
@endsection
@section('maincontianer')
    <div class="container-fluid">


        <div class="mb-3 border-bottom pb-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('invite-link') }}">Invite Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('my-refrences') }}">My Reference</a>
                </li>

            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="form-group">
                    <label for="formGroupExampleInput">Refer Link</label>
                    <input type="text" class="form-control" id="userlink" name="userlink" readonly=""
                        value="{{ url('register?username=' . $userinfo->wallet_address) }}" />
                </div>
                <a href="javascript:void(0)" data-address="{{ url('register?username=' . $userinfo->wallet_address) }}"
                    class="btn btn-danger btn-block withJquery">Copy</a>


            </div>
        </div>

        <div class="mt-3">
            Total Direct Reference : {{ $reffercount }}<br />
            Total Downline : {{ $totaldownline }} <br />
            1st Generation Investment : ${{ number_format($firstgen_amount, 2) }} <br />
            2nd Generation Investment : ${{ number_format($secendgen_amount, 2) }} <br />
            3rd Gen Investment : ${{ number_format($thirdgen_amount, 2) }} <br />
            4th Generation Investment : ${{ number_format($fourgen_amount, 2) }} <br />
            5th Generation Investment : ${{ number_format($fivegen_amount, 2) }} <br />
            6th Generation Investment : ${{ number_format($sixgen_amount, 2) }} <br />
            7th Generation Investment : ${{ number_format($sevengen_amount, 2) }} <br />
            8th Generation Investment : ${{ number_format($eightgen_amount, 2) }} <br />
            9th Generation Investment : ${{ number_format($nonegen_amount, 2) }} <br />
            10th Generation Investment : ${{ number_format($tengen_amount, 2) }} <br />


        </div>

        <div id="container-fluid">

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
