<header class="header">
    <div class="page-brand">
        <a class="link" href="#">
            <span class="brand">Admin
                <span class="brand-tip">CAST</span>
            </span>
            <span class="brand-mini">AC</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li class="d-flex align-items-center">
                <form class="navbar-search" action="javascript:;" style="margin-right: 15px;">
                    <div class="rel">
                        <span class="search-icon"><i class="ti-search"></i></span>
                        <input class="form-control" placeholder="Search here...">
                    </div>
                </form>
                <span
                    style="color: #d2232a; font-weight: 800; font-size: 22px; letter-spacing: 1px; margin-left: 20px;">
                    INDIAN RAILWAYS
                </span>
            </li>


        </ul>
        <ul class="nav navbar-toolbar">
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="{{ asset('assets/img/admin-avatar.png') }}" />
                    <span>{{ Auth::user()->name }}</span><i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a>
                    <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i>Logout</a>
                </ul>
            </li>
        </ul>
    </div>
</header>
