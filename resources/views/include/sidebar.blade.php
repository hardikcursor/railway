<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('assets/img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ Auth::user()->name }}</div><small>Administrator</small>
            </div>
        </div>
        @php
            $dashboardRoute = '';

            if (Auth::check()) {
                if (Auth::user()->hasRole('super-admin')) {
                    $dashboardRoute = route('superadmin.dashboard');
                } elseif (Auth::user()->hasRole('admin')) {
                    $dashboardRoute = route('admin.dashboard');
                } elseif (Auth::user()->hasRole('user')) {
                    $dashboardRoute = route('user.dashboard');
                }
            }
        @endphp

        @php
            $oneMonthPage = '';
            $threeMonthPage = '';
            $sixMonthPage = '';

            if (Auth::check()) {
                if (Auth::user()->hasRole('admin')) {
                    $oneMonthPage = route('admin.report.onemonth');
                    $threeMonthPage = route('admin.report.threemonth');
                    $sixMonthPage = route('admin.report.sixmonth');
                }
            }
        @endphp


        @php
            $oneMonthPage = '';
            $threeMonthPage = '';
            $sixMonthPage = '';

            if (Auth::check()) {
                if (Auth::user()->hasRole('user')) {
                    $oneMonthPage = route('user.report.onemonth');
                    $threeMonthPage = route('user.report.thirdmonth');
                    $sixMonthPage = route('user.report.sixmonth');
                }
            }
        @endphp
        <ul class="side-menu metismenu">
            <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('daily-report') ? 'active' : '' }}">
                <a href="{{ route('daily.report') }}">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Coaching Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('frightdashboard') ? 'active' : '' }}">
                <a href="{{ route('user.frightdashboard') }}">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Freight Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ $oneMonthPage }}">Monthly</a>
                    </li>
                    <li>
                        <a href="{{ $threeMonthPage }}">Quarterly</a>
                    </li>
                    <li>
                        <a href="{{ $sixMonthPage }}">Half Yearly</a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                </ul>
            </li>

           <li >
                <a href="{{ route('user.userdataget') }}">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">User</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
