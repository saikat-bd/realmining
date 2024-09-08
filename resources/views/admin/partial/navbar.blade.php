<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>



    <ul class="nav nav-list">
        <li class="{{ request()->segment(2) == 'dashboard' ? 'active open' : '' }}">
            <a href="{{ url('admin/dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="{{ request()->segment(2) == 'customer' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Customers Info
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="{{ request()->segment(3) == 'index' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Member List
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'activemember' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/activemember') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Active Member
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'deposit' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/deposit') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Deposit List
                    </a>
                    <b class="arrow"></b>
                </li>
                @if (Auth::id() == 699999)
                    <li class="{{ request()->segment(3) == 'transfer' ? 'active' : '' }}">
                        <a href="{{ url('admin/customer/transfer') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Balance Transfer
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="{{ request()->segment(3) == 'transfer-report' ? 'active' : '' }}">
                        <a href="{{ url('admin/customer/transfer-report') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transfer Report
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endif



                <li class="{{ request()->segment(3) == 'member-rank' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/member-rank') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Member Rank
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'royalty-transfer' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/royalty-transfer') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Salary Transfer
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'royalty-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/royalty-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Salary Report
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'withdrawal' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/withdrawal') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Withdrawal
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'withdrawal-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/withdrawal-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Withdrawal Report
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'deposit-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/deposit-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Deposit Report
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'invstment-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/invstment-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Investment Report
                    </a>
                    <b class="arrow"></b>
                </li>


                <li class="{{ request()->segment(3) == 'income-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/income-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Income Report
                    </a>
                    <b class="arrow"></b>
                </li>


                <li class="{{ request()->segment(3) == 'exclusive-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/exclusive-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Exclusive Report
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- <li class="{{ request()->segment(3) == 'tax-report' ? 'active' : '' }}">
                    <a href="{{ url('admin/customer/tax-report') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Vat/Tax Report
                    </a>
                    <b class="arrow"></b>
                </li> --}}

            </ul>
        </li>


        <li class="{{ request()->segment(2) == 'companyfund' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Add Money
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="{{ request()->segment(3) == 'index' ? 'active' : '' }}">
                    <a href="{{ url('admin/companyfund/index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Fund
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'statement' ? 'active' : '' }}">
                    <a href="{{ url('admin/companyfund/statement') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Fund Statement
                    </a>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        {{-- <li class="{{ request()->segment(2) == 'companycommission' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Add Commission
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="{{ request()->segment(3) == 'form' ? 'active' : '' }}">
                    <a href="{{ url('admin/companycommission/form') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Fund
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'statement' ? 'active' : '' }}">
                    <a href="{{ url('admin/companycommission/statement') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Statement
                    </a>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li> --}}


        <li class="{{ request()->segment(2) == 'message' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Message Info
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="{{ request()->segment(3) == 'inbox' ? 'active' : '' }}">
                    <a href="{{ url('admin/message/inbox') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Inbox
                    </a>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>


        <li class="{{ request()->segment(2) == 'settings' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Settings
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{{ request()->segment(3) == 'setting' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/setting') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setting
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'logo' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/logo') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Logo
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'metasetting' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/metasetting') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Meta Title
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'homecontent' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/homecontent') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Home Content
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'about-us' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/about-us') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        About us
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'termsofservice' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/termsofservice') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Terms of Service
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'exclusive-manage' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/exclusive-manage') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Exclusive Plan
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'packagemanage' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/packagemanage') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Package Manages
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'generation' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/generation') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Generation Manages
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->segment(3) == 'wallet-accounts' ? 'active' : '' }}">
                    <a href="{{ url('admin/settings/wallet-accounts') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Wallet Accounts
                    </a>
                    <b class="arrow"></b>
                </li>


            </ul>
        </li>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
