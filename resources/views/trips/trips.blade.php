@extends('layouts.app')

@push('content')

{{--<script>--}}
{{--window.location = 'http://demo.interface.club/limitless/layout_1/LTR/default/invoice_grid.html';--}}
{{--</script>--}}

<div class="content">

    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">

            {{--<div class="navbar navbar-default navbar-xs navbar-component">--}}
            {{--<ul class="nav navbar-nav no-border visible-xs-block">--}}
            {{--<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i--}}
            {{--class="icon-menu7"></i></a></li>--}}
            {{--</ul>--}}

            {{--<div class="navbar-collapse collapse" id="navbar-filter">--}}
            {{--<p class="navbar-text">Filter:</p>--}}
            {{--<ul class="nav navbar-nav">--}}
            {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i--}}
            {{--class="icon-sort-time-asc position-left"></i> By date <span--}}
            {{--class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a href="#">Show all</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="#">Today</a></li>--}}
            {{--<li><a href="#">Yesterday</a></li>--}}
            {{--<li><a href="#">This week</a></li>--}}
            {{--<li><a href="#">This month</a></li>--}}
            {{--<li><a href="#">This year</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i--}}
            {{--class="icon-sort-amount-desc position-left"></i> By status <span--}}
            {{--class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a href="#">Show all</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="#">Open</a></li>--}}
            {{--<li><a href="#">On hold</a></li>--}}
            {{--<li><a href="#">Resolved</a></li>--}}
            {{--<li><a href="#">Closed</a></li>--}}
            {{--<li><a href="#">Dublicate</a></li>--}}
            {{--<li><a href="#">Invalid</a></li>--}}
            {{--<li><a href="#">Wontfix</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i--}}
            {{--class="icon-sort-numeric-asc position-left"></i> By priority <span--}}
            {{--class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a href="#">Show all</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="#">Highest</a></li>--}}
            {{--<li><a href="#">High</a></li>--}}
            {{--<li><a href="#">Normal</a></li>--}}
            {{--<li><a href="#">Low</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--</ul>--}}

            {{--<div class="navbar-right">--}}
            {{--<p class="navbar-text">Sorting:</p>--}}
            {{--<ul class="nav navbar-nav">--}}
            {{--<li class="active"><a href="#"><i class="icon-sort-alpha-asc position-left"></i> Asc</a>--}}
            {{--</li>--}}
            {{--<li><a href="#"><i class="icon-sort-alpha-desc position-left"></i> Desc</a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="text-center content-group text-muted content-divider">--}}
            {{--<span class="pt-10 pb-10">Today</span>--}}
            {{--</div>--}}

            <div class="row">
                @foreach($trips as $trip)
                    <div class="col-md-6">
                        <div class="panel invoice-grid">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6 class="text-semibold no-margin-top">{{ $trip->receiver->name }}</h6>
                                        <ul class="list list-unstyled">
                                            <li>Comanda #: &nbsp;{{ $trip->id }}
                                                <span class="text-semibold">{{ $trip->agreement_date->format('d/m/Y') }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold text-right no-margin-top">
                                            {{ $trip->total_price ?? 0 }} Lei</h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>Metoda Plata:
                                                <span class="text-semibold">{{ $trip->payMethod->name ?? '-' }}</span>
                                            </li>
                                            <li class="dropdown">
                                                Status: &nbsp;
                                                <a href="#" class="label bg-danger-400 dropdown-toggle"
                                                   data-toggle="dropdown">In Curs <span class="caret"></span></a>
                                                <ul class="dropdown-menu dropdown-menu-right active">
                                                    <li class="active"><a href="#"><i class="icon-checkmark3"></i>
                                                            Confirmata</a>
                                                    </li>
                                                    <li><a href="#"><i class="icon-alarm"></i> In Asteptare</a></li>
                                                    <li><a href="#"><i class="icon-alert"></i> Depasire
                                                            Descarcare</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="icon-cross2"></i> Anulata</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed"><a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a>
                                <div class="heading-elements">
                                    {{--{{ dd($trip->toArray()) }}--}}
                                    <span class="heading-text">
                                        <span class="status-mark border-danger position-left"></span>
                                        Prima Incarcare:
                                        <span class="text-semibold">{{ $trip->startPoint->schedule_date->format('m/d/Y') }}
                                            {{ $trip->startPoint->schedule_time ? $trip->startPoint->schedule_time->format('H:i') : '' }}
                                        </span>
                                    </span>
                                    <span class="heading-text">
                                        <span class="status-mark border-danger position-left"></span>
                                        Ultima Descarcare:
                                        <span class="text-semibold">{{ $trip->endPoint->schedule_date->format('m/d/Y') }}
                                            {{ $trip->endPoint->schedule_time ? $trip->endPoint->schedule_time->format('H:i') : '' }}
                                        </span>
                                    </span>

                                    <ul class="list-inline list-inline-condensed heading-text pull-right">
                                        <li>
                                            <a href="#" class="text-default" data-toggle="modal" data-target="#invoice">
                                                <i class="icon-eye8"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu7"></i>
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-printer"></i>Printeaza</a></li>
                                                <li><a href="#"><i class="icon-file-download"></i>Descarca</a></li>
                                                <li><a href="#"><i class="icon-mail5"></i>Trimite prin email</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#"><i class="icon-file-plus"></i>Editeaza</a></li>
                                                {{--<li><a href="#"><i class="icon-cross2"></i>Sterge</a></li>--}}
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        </div>
    </div>


</div>

@endpush

@push('headingElements')

<a href="#" class="btn bg-blue btn-labeled heading-btn">
    <b><i class="icon-plus22"></i></b>
    Comanda Noua
</a>

@endpush
