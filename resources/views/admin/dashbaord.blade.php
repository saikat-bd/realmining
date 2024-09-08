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
                    <a href="#">Home</a>
                </li>
            </ul><!-- /.breadcrumb -->


        </div>

        <div class="page-content">


            <div class="col-md-12" style="margin-bottom:10px;">
                <a style="margin: 5px;" href="{{ url('admin/customer/index') }}" class="btn btn-info">Total Member :
                    {{ $totalusers }} </a>
                <a style="margin: 5px;" href="{{ url('admin/customer/activemember') }}" class="btn btn-primary">Active
                    Member :
                    {{ $acctiveusers }}</a>

                <a style="margin: 5px;" href="" class="btn btn-danger">Member Current Balance :
                    ${{ number_format($currentblance, 2) }}</a>

                <a style="margin: 5px;" href="" class="btn btn-success">Total Rabite :
                    ${{ number_format($rabitincome, 2) }}</a>
                <a style="margin: 5px;" href="" class="btn btn-primary">Total Generation:
                    ${{ number_format($geneationsum, 2) }}</a>
                <a style="margin: 5px;" href="{{ url('admin/customer/deposit-report') }}" class="btn btn-danger">Total
                    Deposit :
                    ${{ number_format($totaldeposit, 2) }}</a>
                <a style="margin: 5px;" href="{{ url('admin/customer/withdrawal-report') }}" class="btn btn-success">Total
                    Withdrawal :
                    ${{ number_format($withdrawal, 2) }}</a>
                <a style="margin: 5px;" href="{{ url('admin/customer/royalty-report') }}" class="btn btn-danger">Monthly
                    Salary :
                    ${{ number_format($salarymonth, 2) }}</a>
                <a style="margin: 5px;" href="" class="btn btn-info">Rank Incentive :
                    {{ number_format($rankinsentamont, 2) }}</a>



                <a style="margin: 5px;" href="{{ url('admin/settings/packagemanage') }}" class="btn btn-success">Investment
                    Plan</a>

                <a style="margin: 5px;" href="{{ url('admin/settings/generation') }}" class="btn btn-success">Generation
                    Plan</a>

                <a style="margin: 5px;" href="{{ url('admin/settings/wallet-accounts') }}" class="btn btn-success"> Binance
                    Account
                </a>

                <a style="margin: 5px;" href="{{ url('admin/settings/exclusive-manage') }}" class="btn btn-success">
                    Exclusive Plan
                </a>
                <a style="margin: 5px;" href="{{ url('admin/settings/setting') }}" class="btn btn-success">
                    Settings
                </a>

                <a style="margin: 5px;" href="{{ url('admin/customer/member-rank') }}" class="btn btn-success">
                    Member Rank
                </a>
                @if (Auth::id() == 699999)
                    <a style="margin: 5px;" href="{{ url('admin/customer/invstment-report') }}"
                        class="btn btn-success">Total
                        Investment :
                        ${{ number_format($investment, 2) }} </a>

                    <a style="margin: 5px;" href="{{ url('admin/customer/transfer') }}" class="btn btn-success">
                        Balance Transfer
                    </a>

                    <a style="margin: 5px;" href="{{ url('admin/customer/transfer-report') }}" class="btn btn-danger">
                        Transfer History
                    </a>
                @endif


                <a style="margin: 5px;" href="{{ url('admin/customer/royalty-transfer') }}" class="btn btn-success">
                    Salary Transfer
                </a>



            </div>


        </div><!-- /.page-content -->
    </div>
@endsection
