@extends('layouts.app')

@section('layout-content')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-2">
    <div class="layout-inner">

        <!-- Layout sidenav -->
        @include('layouts.includes.layout-sidenav')

        <!-- Layout container -->
        <div class="layout-container">
            <!-- Layout navbar -->
            @include('layouts.includes.layout-navbar')

            <!-- Layout content -->
            <div class="layout-content">

                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">

                    <h4 class="font-weight-bold py-3 mb-1">
                        @stack('breadcrumbs')
                    </h4>

                    @if (session('success'))
                        <div role="alert" class="alert alert-dark-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div role="alert" class="alert alert-dark-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @isset($errors)
                        @if ($errors->any())
                            <div role="alert" class="alert alert-dark-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endisset

                    @yield('content')
                </div>
                <!-- / Content -->

                <!-- Layout footer -->
                @include('layouts.includes.layout-footer')
            </div>
            <!-- Layout content -->

        </div>
        <!-- / Layout container -->

    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->
@endsection
