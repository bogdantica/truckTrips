@extends('layouts.app')

@push('content')


@if(!empty($trip))
    @include('trips.running',['trip' => $trip])
@endif

<div class="row">
    <div class="col-xs-3 hidden-xs"></div>

    @if(!empty($trip))

        <div class="col-xs-6 col-sm-3">
            <a href="{{ route('trip.end',['trip' => $trip->id,'endTrip' => true]) }}">
                <div class="panel bg-primary-600 panel-bordered text-center">
                    <div class="panel-body">
                        <div class="dashboard-action">
                            <i class="icon-truck"></i>
                        </div>
                        <h2>Incheie</h2>
                    </div>
                </div>
            </a>
        </div>

    @else
        <div class="col-xs-6 col-sm-3">
            <a href="{{ route('trip.new') }}">
                <div class="panel bg-success-600 panel-bordered text-center">
                    <div class="panel-body">
                        <div class="dashboard-action">
                            <i class="icon-truck"></i>
                        </div>
                        <h2>Cursa Noua</h2>
                    </div>
                </div>
            </a>
        </div>
    @endif

    <div class="col-xs-6 col-sm-3">
        <a href="#">
            <div class="panel bg-warning-600 panel-bordered text-center">
                <div class="panel-body">
                    <div class="dashboard-action">
                        <i class="icon-gas"></i>
                    </div>
                    <h2>Alimentare</h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-3 hidden-xs"></div>
</div>

@endpush