<!-- Layout navbar -->
<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

    <!-- Brand demo (see resources/assets/css/demo.css) -->
    <a href="/" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
        <span class="app-brand-logo">
            <img src="/logo-32x32.png" width="32" height="32">
        </span>
        <span class="app-brand-text demo font-weight-normal ml-2">{{ config('app.name') }}</span>
    </a>

    @empty($hide_layout_sidenav_toggle)
    <!-- Sidenav toggle (see resources/assets/css/demo.css) -->
    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>
    @endempty

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
        <!-- Divider -->
        <hr class="d-lg-none w-100 my-2">

        <div class="navbar-nav align-items-lg-center ml-auto">
            <div class="demo-navbar-user nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                        <img src="/images/avatar.png" alt class="d-block ui-w-30 rounded-circle">
                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="ion ion-ios-log-out text-danger"></i> &nbsp; Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- / Layout navbar -->
