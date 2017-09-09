@extends('layouts.app')

@push('content')

{{--<form action="#">--}}
{!! Form::open(['url' => route('trip.start'),'type' => 'POST']) !!}
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend class="text-semibold"><i class="icon-truck position-left"></i> Date cursa</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group has-feedback has-feedback-left">
                                {!! Form::select('sender_company_id',$companies,$companies->keys()->first(),['class' => 'form-control input-xlg companyInput', 'data-placeholder' => 'Expeditor','placeholder' => 'Expeditor']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-office"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::select('receiver_company_id',$companies,$companies->keys()->first(),['class' => 'form-control input-xlg companyInput', 'data-placeholder' => 'Destinatar', 'placeholder' => 'Destinatar']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-office"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::select('truck_id',$trucks,$trucks->keys()->first(),['class' => 'form-control input-xlg truckInput', 'data-placeholder' => 'Camion','placeholder' => 'Camion']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-truck"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::hidden('driver_user_id',$driver->id) !!}
                                {!! Form::select('driver_user_id',$drivers,$driver->id,['class' => 'form-control input-xlg driverInput', 'data-placeholder' => 'Sofer','disabled']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-man"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::text('load_weight',null,['class' => 'form-control input-xlg','placeholder' => 'Masa Net - tona']) !!}
                                <div class="form-control-feedback">
                                    <i class="fa fa-balance-scale"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::text('load_volume',null,['class' => 'form-control input-xlg','placeholder' => 'Volum - m3 - optional']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-rulers"></i>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::text('pay_distance',null,['class' => 'form-control input-xlg','placeholder' => 'Distanta oferita - in Km']) !!}
                                <div class="form-control-feedback">
                                    <i class=" icon-road"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-real">
                                {!! Form::text('real_distance',null,['class' => 'form-control input-xlg','placeholder' => 'Distanta reala - in Km - Optional']) !!}
                                <div class="form-control-feedback">
                                    <i class=" icon-road"></i>
                                </div>

                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>

            <div class="col-md-6">

                <fieldset>
                    <legend class="text-semibold"><i class="icon-airplane3 position-left"></i>Plecare</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                {!! Form::hidden('start_point[latitude]',null,['class' => 'startLatitude']) !!}
                                {!! Form::hidden('start_point[longitude]',null,['class' => 'startLongitude']) !!}
                                {!! Form::select('start_point[place_id]',[],null,['class' => 'form-control input-xlg placeInput', 'data-placeholder' => 'Plecare Din']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-airplane3"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::text('start_point[current_kilometers]',null,['class' => 'form-control input-xlg', 'placeholder' => 'Kilometraj Plecare']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-meter2"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Ora Plecare</label>
                                {!! Form::text('start_point[departed_at]',\Carbon\Carbon::now()->addHours('3')->format('d/m/Y H:i'),['class' => 'form-control input-xlg inputTime', 'placeholder' => 'Timp Plecare']) !!}
                                <div class="form-control-feedback">
                                    <i class="glyphicon glyphicon-time"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>Detalii</label>
                                <textarea name="start_point[description]" placeholder="Optional"
                                          class="form-control input-xlg"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="text-semibold"><i class="icon-airplane4 position-left"></i>Sosire</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                {!! Form::select('end_point[place_id]',[],null,['class' => 'form-control input-xlg placeInput', 'data-placeholder' => 'Sosire In']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-airplane3"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::text('end_point[current_kilometers]',null,['class' => 'form-control input-xlg', 'placeholder' => 'Kilometraj Sosire']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-meter2"></i>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Ora Sosire</label>
                                {!! Form::text('end_point[departed_at]',null,['class' => 'form-control input-xlg inputTime' , 'placeholder' => 'La sosire','disabled']) !!}
                                <div class="form-control-feedback">
                                    <i class="glyphicon glyphicon-time"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>Detalii</label>
                                <textarea placeholder="Optional" class="form-control input-xlg"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>


            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Porneste in cursa <i
                        class="icon-truck position-right"></i></button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endpush

@push('scripts')

<script>
    $('.companyInput').select2({
        tags: true
    });

    $('.truckInput').select2({
        tags: true
    });
    $('.driverInput').select2();


    $('.inputTime').datetimepicker({
        viewMode: 'days',
        format: 'DD/MM/YYYY HH:mm'
    });


    $('.placeInput').select2({
        ajax: {
            url: "{{ route('places') }}",
            dataType: 'json',
            delay: 100,
            data: function (params) {
                return {
                    place: params.term
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items
                };
            },
            cache: true
        },
        minimumInputLength: 2
    });

    (function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (params) {
                $('.startLatitude').val(params.coords.latitude);
                $('.startLongitude').val(params.coords.longitude);
            });
        }
    })();


    $('form').form2();

</script>

@endpush