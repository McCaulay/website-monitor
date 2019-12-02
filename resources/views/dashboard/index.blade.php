@extends('layouts.layout')

@section('title', 'Dashboard')

@push('breadcrumbs')
Dashboard
@endpush

@section('content')

    <h4 class="media align-items-center font-weight-bold py-3 mb-4">
        <img src="/images/avatar.png" alt="" class="ui-w-50 rounded-circle">
        <div class="media-body ml-3">
            Welcome back, {{ Auth::user()->name }}!
            <div class="text-muted text-tiny mt-1"><small class="font-weight-normal">Today is {{ now()->format('l, jS F Y') }}</small></div>
        </div>
    </h4>

    <hr class="container-m-nx mt-0 mb-4">

    <div class="row">
        <div class="d-flex col-xl-6 align-items-stretch">

            <!-- Stats + Links -->
            <div class="card d-flex w-100 mb-4">
                <div class="row no-gutters row-bordered h-100">
                    @component('components.stat-block', ['icon' => 'license', 'small' => 'Currently active'])
                        <span class="font-weight-bolder">{{ $websites->count() }}</span> Website{{ $websites->count() != 1 ? 's' : '' }}
                    @endcomponent

                    @component('components.stat-block', ['icon' => 'hourglass', 'small' => 'Averge today'])
                        <span class="font-weight-bolder">152ms</span> Response Time
                    @endcomponent

                    @component('components.stat-block', ['icon' => 'checkmark-circle', 'small' => 'Completed today'])
                        <span class="font-weight-bolder">54</span> Checks
                    @endcomponent
                    
                    @component('components.stat-block', ['icon' => 'alarm', 'small' => 'Notifications this month'])
                        <span class="font-weight-bolder">42</span>
                    @endcomponent

                </div>
            </div>
            <!-- / Stats + Links -->

        </div>
        <div class="d-flex col-xl-6 align-items-stretch">

            <!-- Chart -->
            <div class="card w-100 mb-4">
                <div class="card-body">
                    <div class="text-muted small">Response times</div>
                    <div class="text-big">Average Load</div>
                </div>
                <div class="px-2 mt-4">
                    <div class="w-100" style="height: 120px;">
                        <canvas id="statistics-chart-1"></canvas>
                    </div>
                </div>
            </div>
            <!-- / Chart -->

        </div>
    </div>

    @if ($websites->count() > 0)
        <hr class="container-m-nx mt-0 mb-4">
        <h6 class="font-weight-semibold mb-4">Current Websites</h6>

        <!-- Websites -->
        @foreach ($websites as $website)
            <div class="card pb-4 mb-2">
                <div class="row no-gutters align-items-center">
                    <div class="col-12 col-md-5 px-4 pt-4">
                        <a href="javascript:void(0)" class="text-body font-weight-semibold">{{ $website->name }}</a><br>
                        <a href="{{ $website->url }}" target="_blank"><small class="text-muted">{{ $website->url }}</small></a>
                    </div>
                    @if ($website->lastCheck() != null)
                        <div class="col-4 col-md-2 text-muted small px-4 pt-4">
                            <span class="badge badge-success">Active</span>
                        </div>
                        <div class="col-4 col-md-2 text-muted small px-4 pt-4">
                            {{ $website->lastCheck()->created_at->format('j M Y') }}
                            <br>
                            {{ $website->lastCheck()->created_at->format('G:i') }}
                        </div>
                        <div class="col-4 col-md-3 px-4 pt-4">
                            <div class="text-right text-muted small">{{ $website->lastCheck()->percentage }}%</div>
                            <div class="progress" style="height: 6px;">
                                <div
                                    class="
                                        progress-bar
                                        @if ($website->lastCheck()->percentage > 70)
                                            bg-success
                                        @elseif ($website->lastCheck()->percentage > 40)
                                            bg-warning
                                        @else
                                            bg-danger
                                        @endif
                                    " 
                                    style="width: {{ $website->lastCheck()->percentage }}%;"
                                ></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <!-- / Websites -->
    @endif
@endsection
