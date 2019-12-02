<?php $routeName = Route::currentRouteName(); ?>

<!-- Layout sidenav -->
<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">
    @empty($layout_sidenav_horizontal)
    <div class="app-brand demo">
        <span class="app-brand-logo">
            <img src="/logo-32x32.png" width="32" height="32">
        </span>
        <a href="/" class="app-brand-text demo sidenav-text font-weight-normal ml-2">{{ config('app.name') }}</a>
        <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>

    <div class="sidenav-divider mt-0"></div>
    @endempty

    <!-- Links -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <!-- Dashboard -->
        <li class="sidenav-item{{ $routeName == 'dashboard' ? ' active' : '' }}">
            <a href="{{ route('dashboard') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-list"></i><div>Dashboard</div></a>
        </li>

    </ul>
</div>
<!-- / Layout sidenav -->
