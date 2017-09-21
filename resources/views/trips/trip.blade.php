@extends('layouts.app')

@push('content')

<div class="panel panel-white">

    <div class="panel-heading">
        <h6 class="panel-title">Cursa Noua</h6>
    </div>

    <form class="steps-basic" action="#">
        <h6>Date cursa</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Comenzii:</label>
                        {{ Form::text('agreement_date',$trip->agreement_date ? $trip->agreement_date->format('m/d/Y') : null,['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client:</label>
                        {{ Form::select('receiver_company_id',$companies,$trip->receiver_company_id ?? null,['class' => 'select form-control']) }}
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Vehicule:</label>
                        {{ Form::select('vehicles',$vehicles,null,['class' => 'form-control','multiple']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sofer:</label>
                        {{ Form::select('driver_user_id',$drivers,$trip->driver_user_id ?? null,['class' => 'select form-control']) }}
                    </div>
                </div>

            </div>
        </fieldset>

        <h6>Incarcare</h6>
        <fieldset>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Locatie</label>
                                {!! Form::select('start_point[place_id]',[],$trip->startPoint->place_id ?? null,['class' => 'form-control input-xlg placeInput', 'data-placeholder' => 'Incarcare']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-airplane3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Data</label>
                                {!! Form::text('start_point[schedule_date]',($trip->startPoint->schedule_date ?? false ) ? $trip->schedule_date->format('d/m/Y') : null,['class' => 'form-control input-xlg inputDate', 'placeholder' => 'Data Incarcare']) !!}
                                <div class="form-control-feedback">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Ora</label>
                                {!! Form::text('start_point[schedule_time]',($trip->startPoint->schedule_time ?? false )? $trip->schedule_time->format('H:i') : null,['class' => 'form-control input-xlg inputTime', 'placeholder' => 'Ora Incarcare']) !!}
                                <div class="form-control-feedback">
                                    <i class="glyphicon glyphicon-time"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Greutate Totala - KG</label>
                                {!! Form::text('start_point[cargo_weight]',$trip->startPoint->cargo_weight ?? null,['class' => 'form-control input-xlg ', 'placeholder' => 'Greutate KG']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-balance"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left ">
                                <label>Volum Total - M<sup>3</sup></label>
                                {!! Form::text('start_point[cargo_volume]',$trip->startPoint->cargo_volume ?? null,['class' => 'form-control input-xlg inputTime', 'placeholder' => 'Volumn M3']) !!}
                                <div class="form-control-feedback">
                                    <i class=" icon-rulers"></i>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="form-group ">
                <label>Detalii</label>
                {{ Form::textarea('start_point[details]',$trip->startPoint->details ?? null,['class' => 'form-control input-xlg','rows' => 4]) }}
            </div>

        </fieldset>

        <h6>Tarife</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Serviciu</label>
                        {!! Form::text('services[index][name]',null,['class' => 'form-control input-xlg', 'data-placeholder' => 'Serviciu/Produs']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-pencil3"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Cantitate</label>
                        {!! Form::text('services[index][quantity]',null,['class' => 'form-control input-xlg', 'data-placeholder' => 'Cantitate']) !!}
                        <div class="form-control-feedback">
                            <i class=" icon-balance"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Pret</label>
                        {!! Form::text('services[index][price]',null,['class' => 'form-control input-xlg', 'data-placeholder' => 'Cantitate']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-coin-euro"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Total</label>
                        {!! Form::text('services[index][total]',null,['class' => 'form-control input-xlg', 'data-placeholder' => 'Cantitate']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-coins"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pull-right">
                    <button type="button" class="btn btn-warning newTripPoint pull-right">
                        <i class="icon-calculator3 position-left"></i>
                        Adauga Serviciu
                    </button>
                </div>
            </div>
        </fieldset>

        <h6>Contract Comanda</h6>

        <fieldset>
            {{ Form::textarea('agreement',$trip->agreement ?? null,['class' => 'tripAgreementBody form-control','rows' => 5]) }}
        </fieldset>


    </form>

</div>


{{--{!! Form::open(['url' => route('trip.start'),'type' => 'POST']) !!}--}}
{{--<div class="panel panel-flat">--}}
{{--<div class="panel-body">--}}
{{--<div class="col-xs-12">--}}
{{--</div>--}}
{{--<div class="text-right">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--Salveaza--}}
{{--<i class="icon-truck position-right"></i>--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="panel panel-flat">--}}
{{--<div class="panel-body">--}}


{{--</div>--}}
{{--</div>--}}

{{--<div class="panel panel-flat">--}}
{{--<div class="panel-body">--}}
{{--<fieldset>--}}

{{--<legend class="text-semibold">--}}

{{--<div class="row">--}}
{{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">--}}
{{--<i class="icon-airplane3 position-left"></i>Descarcare--}}
{{--</div>--}}
{{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">--}}
{{--<button type="button" class="btn btn-warning newTripPoint pull-right">--}}
{{--<i class="icon-location4 position-left"></i>--}}
{{--Adauga punct intermediar--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</legend>--}}

{{--<div class="text-right">--}}

{{--</div>--}}
{{--</legend>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<div class="form-group has-feedback has-feedback-left ">--}}
{{--<label>Locatie</label>--}}
{{--{!! Form::select('end_point[place_id]',[],$trip->endPoint->place_id ?? null,['class' => 'form-control input-xlg placeInput', 'data-placeholder' => 'Descarcare']) !!}--}}
{{--<div class="form-control-feedback">--}}
{{--<i class="icon-airplane3"></i>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-4">--}}
{{--<div class="form-group has-feedback has-feedback-left ">--}}
{{--<label>Data</label>--}}
{{--{!! Form::text('end_point[schedule_date]',($trip->endPoint->schedule_date ?? false ) ? $trip->schedule_date->format('d/m/Y') : null,['class' => 'form-control input-xlg inputDate', 'placeholder' => 'Data Descarcare']) !!}--}}
{{--<div class="form-control-feedback">--}}
{{--<i class="glyphicon glyphicon-calendar"></i>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-4">--}}
{{--<div class="form-group has-feedback has-feedback-left ">--}}
{{--<label>Ora</label>--}}
{{--{!! Form::text('end_point[schedule_time]',($trip->endPoint->schedule_time ?? false )? $trip->schedule_time->format('H:i') : null,['class' => 'form-control input-xlg inputTime', 'placeholder' => 'Ora Descarcare']) !!}--}}
{{--<div class="form-control-feedback">--}}
{{--<i class="glyphicon glyphicon-time"></i>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group has-feedback has-feedback-left ">--}}
{{--<label>Greutate Totala - KG</label>--}}
{{--{!! Form::text('end_point[cargo_weight]',$trip->endPoint->cargo_weight ?? null,['class' => 'form-control input-xlg ', 'placeholder' => 'Greutate KG']) !!}--}}
{{--<div class="form-control-feedback">--}}
{{--<i class="icon-balance"></i>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group has-feedback has-feedback-left ">--}}
{{--<label>Volum Total - M<sup>3</sup></label>--}}
{{--{!! Form::text('end_point[cargo_volume]',$trip->endPoint->cargo_volume ?? null,['class' => 'form-control input-xlg inputTime', 'placeholder' => 'Volumn M3']) !!}--}}
{{--<div class="form-control-feedback">--}}
{{--<i class=" icon-rulers"></i>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group ">--}}
{{--<label>Detalii</label>--}}
{{--{{ Form::textarea('end_point[details]',$trip->endPoint->details ?? null,['class' => 'form-control input-xlg','rows' => 4]) }}--}}
{{--</div>--}}

{{--</fieldset>--}}


{{--</div>--}}
{{--</div>--}}

{{--<div class="panel panel-flat">--}}
{{--<div class="panel-body">--}}


{{--</div>--}}
{{--</div>--}}

{{--<div class="panel panel-flat">--}}
{{--<div class="panel-body">--}}
{{--</div>--}}
{{--</div>--}}


{!! Form::close() !!}
@endpush

@push('scripts')

<script>

    //    $('.tripAgreementBody').wysihtml5({
    ////        parserRules: wysihtml5ParserRules,
    //        stylesheets: ["assets/css/components.css"]
    //    });

    $(".steps-basic").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        saveState: true,
        enableContentCache: true,
        preloadContent: true,

        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        labels: {
            finish: 'Salveaza'
        },
        onFinished: function (event, currentIndex) {
            alert("Cursa Creata.");
        }
    });


    $('.companyInput').select2({
        tags: {{--<div class="text-right">--}}true
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
            {{--url: "{{ route('places') }}",--}}
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

    //    (function () {
    //        if (navigator.geolocation) {
    //            navigator.geolocation.getCurrentPosition(function (params) {
    //                $('.startLatitude').val(params.coords.latitude);
    //                $('.startLongitude').val(params.coords.longitude);
    //            });
    //        }
    //    })();


    $('form').form2();

</script>

@endpush