@extends('layouts.layout-blank')

@push('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/authentication.css') }}">
@endpush

@section('content')
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('/images/bg/1.jpg');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">

            <div class="card">
                <div class="p-4 px-sm-5 pt-sm-5">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-60 mb-2">
                            <div class="position-relative" style="padding-bottom: 54%">
                                <img src="/logo-64x64.png" class="position-absolute" width="64" height="64">
                            </div>
                        </div>
                    </div>
                    <!-- / Logo -->

                    <h5 class="text-center text-muted font-weight-normal mb-4">@yield('header')</h5>

                    @yield('body')
                </div>

                @hasSection('footer')
                    <div class="card-footer py-3 px-4 px-sm-5">
                        <div class="text-center text-muted">
                            @yield('footer')
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
