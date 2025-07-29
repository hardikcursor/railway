<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('assets/img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ Auth::user()->name }}</div>
                <small>{{ ucfirst(Auth::user()->roles->pluck('name')->first()) }}</small>
            </div>
        </div>

        {{-- Dashboard and Report Routes --}}
        @php
            $dashboardRoute = '';
            $oneMonthPage = '';
            $threeMonthPage = '';
            $sixMonthPage = '';

            if (Auth::check()) {
                if (Auth::user()->hasRole('super-admin')) {
                    $dashboardRoute = route('superadmin.dashboard');
                } elseif (Auth::user()->hasRole('admin')) {
                    $dashboardRoute = route('admin.dashboard');
                    $oneMonthPage = route('admin.report.onemonth');
                    $threeMonthPage = route('admin.report.threemonth');
                    $sixMonthPage = route('admin.report.sixmonth');
                } elseif (Auth::user()->hasRole('user')) {
                    $dashboardRoute = route('user.dashboard');
                    $oneMonthPage = route('user.report.onemonth');
                    $threeMonthPage = route('user.report.thirdmonth');
                    $sixMonthPage = route('user.report.sixmonth');
                }
            }
        @endphp

        <ul class="side-menu metismenu">
            <li class="{{ Request::url() == $dashboardRoute ? 'active' : '' }}">
                <a href="{{ $dashboardRoute }}">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <li class="heading">FEATURES</li>

            {{-- Reports Menu --}}
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i>
                </a>
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
                </ul>
            </li>

            @role('super-admin')
                <li>
                    <a href="{{ route('superadmin.userdataget') }}">
                        <i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">User</span>
                    </a>
                </li>
            @endrole

            @role('admin')
                <li>
                    <a href="{{ route('admin.quotationshow') }}">
                        <i class="sidebar-item-icon fa-solid fa-file-pen"></i>
                        <span class="nav-label">Add/Edit Quations</span>
                    </a>
                </li>
            @endrole


            {{-- @role('admin')
                <li>
                    <a href="{{ route('admin.generateReport') }}">
                        <i class="sidebar-item-icon fa-solid fa-user-pen"></i>
                        <span class="nav-label">Generate Quation</span>
                    </a>
                </li>
            @endrole --}}

        </ul>
    </div>
</nav>
