@extends('users.master')
@section('title')
    <title>Like-Invite linl</title>
@endsection
@section('sub_title')
    Invite Link
@endsection
@section('maincontianer')
    <div class="container-fluid">

        <div>
            Total Direct Reference : {{ $reffercount }}<br />
            Total Downline : {{ $totaldownline }} <br />
            1st Gen Investment : ${{ number_format($firstgen_amount, 2) }} <br />
            2nd Gen Investment : ${{ number_format($secendgen_amount, 2) }} <br />
            3rd Gen Investment : ${{ number_format($thirdgen_amount, 2) }} <br />
            4th Gen Investment : ${{ number_format($fourgen_amount, 2) }} <br />
            5th Gen Investment : ${{ number_format($fivegen_amount, 2) }} <br />
            Downline Investment :
            ${{ number_format($firstgen_amount + $secendgen_amount + $thirdgen_amount + $fourgen_amount + $fivegen_amount, 2) }}
            <br />

        </div>

        <div id="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="form-group">
                        <label for="formGroupExampleInput">Link</label>
                        <input type="text" class="form-control" id="userlink" name="userlink" readonly=""
                            value="{{ url('register?username=' . $userinfo->wallet_address) }}" />
                    </div>
                    <a href="javascript:void(0)" data-address="{{ url('register?username=' . $userinfo->wallet_address) }}"
                        class="btn btn-success btn-block withJquery">Copy</a>

                    <a href="{{ url('my-refrences') }}" class="btn btn-danger btn-block">My Reference</a>

                </div>
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
