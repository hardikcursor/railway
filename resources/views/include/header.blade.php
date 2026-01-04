<header class="header">
    <div class="page-brand">
        <a class="link" href="#">
            <span class="brand">
                <span class="brand-tip"></span>
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
                 
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i>Logout</a>
                </ul>
            </li>
        </ul>
    </div>
</header>
<style>



.header .flexbox {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.navbar-toolbar {
    display: flex;
    align-items: center;
}

.navbar-search {
    max-width: 160px;
}

.navbar-search input {
    width: 100%;
}

@media (max-width: 992px) {
    .navbar-search {
        max-width: 180px;
    }

    .header span[style*="INDIAN RAILWAYS"] {
        font-size: 18px !important;
        margin-left: 10px !important;
    }
}

@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: stretch;
    }

    .header .flexbox {
        flex-direction: row;
        align-items: center;
    }

    .navbar-toolbar {
        gap: 10px;
    }

    .navbar-search {
        max-width: 140px;
    }

    .header span[style*="INDIAN RAILWAYS"] {
        font-size: 16px !important;
        letter-spacing: 0.5px !important;
    }

    .dropdown-user span {
        display: none;
    }
}

@media (max-width: 480px) {
    .navbar-search {
        display: none;
    }

    .header span[style*="INDIAN RAILWAYS"] {
        display: none;
    }
}

</style>