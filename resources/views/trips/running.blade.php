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
                                <h5 class="text-semibold no-margin">{{ $trip->startPoint->place->name }}</h5>
                                <ul class="list-inline list-inline-condensed no-margin">

                                    @if($trip->startPoint->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->startPoint->departed_at->format('H:m m/d/Y')}}</span>
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
                                    @if($trip->endPoint->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->endPoint->departed_at->format('H:m m/d/Y')}}</span>
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
                                <h5 class="text-semibold no-margin">{{ $trip->endPoint->place->name }}</h5>
                                <ul class="list-inline list-inline-condensed no-margin">
                                    @if($trip->endPoint->departed_at)
                                        <li>
                                            <span class="status-mark border-success"></span>
                                        </li>
                                        <li>
                                            <span class="text-muted">{{  $trip->endPoint->departed_at->format('H:m m/d/Y')}}</span>
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

<div class="modal fade" id="endTripModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Incheie Cursa</h4>
            </div>
            {!! Form::open(['url' => route('trip.end',['trip' => $trip->id]),'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group has-feedback has-feedback-left">
                    {!! Form::hidden('end_point[latitude]',null,['class' => 'endLatitude']) !!}
                    {!! Form::hidden('end_point[longitude]',null,['class' => 'endLongitude']) !!}

                    {!! Form::text('end_point[current_kilometers]',null,['class' => 'form-control input-xlg', 'placeholder' => 'Kilometraj Sosire']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-meter2"></i>
                    </div>
                </div>
                <div class="form-group has-feedback has-feedback-left ">
                    <label>Ora Sosire</label>
                    {!! Form::text('end_point[departed_at]',\Carbon\Carbon::now()->addHours('3')->format('d/m/Y H:i'),['class' => 'form-control input-xlg inputTime']) !!}
                    <div class="form-control-feedback">
                        <i class="glyphicon glyphicon-time"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg">Cursa Terminata</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Inchide</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>

@push('scripts')
<script>

    $('#endTripModal').on('shown.bs.modal', function () {
        (function () {
            console.log('here');
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (params) {
                    $('.startLatitude').val(params.coords.latitude);
                    $('.startLongitude').val(params.coords.longitude);
                });
            }
        })();
    });

    $('form').form2();
</script>
@endpush