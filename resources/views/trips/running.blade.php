<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Cursa Curenta</h6>
            </div>

            {{--todo refactor this for responsive--}}

            <div class="table-responsive">
                <table class="table table-lg text-nowrap">
                    <tbody>
                    <tr>
                        <td class="col-md-4">
                            <div class="media-left">
                                <div class="currentTripIcon">
                                    <i class="icon-airplane3 position-left"></i>
                                </div>
                            </div>

                            <div class="media-left">
                                <h5 class="text-semibold no-margin">{{ $trip->basicPoints->first()->place->name }}</h5>
                                <ul class="list-inline list-inline-condensed no-margin">

                                    @if($trip->basicPoints->first()->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->basicPoints->first()->departed_at->format('H:m m/d/Y')}}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>

                        <td class="col-md-4">
                            <div class="media-left">
                                <div class="currentTripIcon">
                                    <i class="icon-truck position-left"></i>
                                </div>
                            </div>
                            <div class="media-left">
                                <h5 class="text-semibold no-margin">{{ $trip->truck->registration }}</h5>
                                <h6 class="text-semibold no-margin">{{ $trip->truck->name }}</h6>
                                <ul class="list-inline list-inline-condensed no-margin">
                                    @if($trip->basicPoints->last()->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->basicPoints->last()->departed_at->format('H:m m/d/Y')}}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>


                        <td class="col-md-4 text-right">
                            <div class="media-left pull-right">
                                <div class="currentTripIcon">
                                    <i class="icon-airplane4 position-left"></i>
                                </div>
                            </div>
                            <div class="media-left pull-right">
                                <h5 class="text-semibold no-margin">{{ $trip->basicPoints->last()->place->name }}</h5>
                                <ul class="list-inline list-inline-condensed no-margin">
                                    @if($trip->basicPoints->last()->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->basicPoints->last()->departed_at->format('H:m m/d/Y')}}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th>Expeditor</th>
                        <th>Destinatar</th>
                        <th>Distanta</th>
                        <th>Masa Net</th>
                        <th>Volum</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $trip->sender->name }}</td>
                        <td>{{ $trip->receiver->name }}</td>
                        <td>{{ $trip->pay_distance }} <strong>Km</strong></td>
                        <td>{{ $trip->load_weight ?? '-' }} <strong>Ton</strong></td>
                        <td>{{ $trip->load_volume ?? '-' }} <strong>M<sup>3</sup></strong></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
