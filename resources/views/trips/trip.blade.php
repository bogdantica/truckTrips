@extends('layouts.app')

@push('content')


{{--{{ dd($trip->toArray()) }}--}}

<div class="panel panel-white">

    <div class="panel-heading">
        <h6 class="panel-title">Cursa Noua</h6>
    </div>

    {{--<form class="steps-basic" action="#">--}}

        {!! Form::open(['url' => $trip->id ? route('trips.edit') : route('trips.new'), 'method' =>$trip->id ? 'PUT' : 'POST','class' => 'steps-basic' ]) !!}

        <h6>Date cursa</h6>
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Data Comenzii:</label>
                        {{ Form::text('agreement_date',$trip->agreement_date ? $trip->agreement_date->format('d/m/Y') : null,['class' => 'form-control inputDate']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group input-group has-feedback has-feedback-left companyContainer">
                        <label>Client:</label>
                        {{ Form::select('receiver_company_id',$companies,$trip->receiver_company_id ?? null,['class' => 'companyInput form-control']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success newCompanyAction">
                                Client Nou
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group input-group">
                        <label>Vehicule:</label>
                        {{ Form::select('vehicles',$vehicles,null,['class' => 'form-control select ','multiple']) }}
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success">
                                Vehicul Nou
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group input-group">
                        <label>Sofer:</label>
                        {{ Form::select('driver_user_id',$drivers,$trip->driver_user_id ?? null,['class' => 'select form-control']) }}
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success">
                                Sofer Nou
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

    <h6>Incarcare</h6>
    <fieldset>
        @include('trips.elements.point',['inputPrefix' => 'startPoint','point' => $trip->startPoint])
    </fieldset>
        <h6>Puncte Aditionale</h6>
        <fieldset>
            <div class="newPointModel">
                @include('trips.elements.point',['inputPrefix' => 'point[new][currentIndex]','point' => null])
            </div>

            @foreach($trip->points as $point)

                @include('trips.elements.point',['inputPrefix' => 'point[old]['.$point->id.']','point' => $point,'remove' => true])

            @endforeach

        </fieldset>

        <h6>Descarcare</h6>
        <fieldset>

            @include('trips.elements.point',['inputPrefix' => 'endPoint','point' => $trip->endPoint])

        </fieldset>

        <h6>Tarife</h6>
        <fieldset>
            @include('trips.elements.services',['services' => $trip->services])
        </fieldset>

        <h6>Contract Comanda</h6>

        <fieldset>

            {{--<div id="agreement" contenteditable="true">--}}
            {{--{!! $trip->agreement !!}--}}
            {{--</div>--}}
            {{ Form::textarea('agreement',$trip->agreement ?? null,['class' => 'tripAgreementBody form-control','rows' => 5,'id' => 'agreement']) }}
        </fieldset>

    </form>

</div>

{!! Form::close() !!}
@endpush

@push('scripts')

<script>

    $(document).ready(function () {

        $('.companyContainer .newCompanyAction').modalView({
            elementSelector: '.newCompanyContainer',
            url: '{{ route('companies.new') }}'
        });

    });

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
            var $this = $(this);
            $this.submit();
        }
    });


    $('.companyInput').select2({
        tags: {{--<div class="text-right">--}}true
    });

    //    $('.truckInput').select2({
    //        tags: true
    //    });

    //    $('.driverInput').select2();

    $("select:not([class^=\"select2\"])").select2();

    $('.inputDate').daterangepicker({
        singleDatePicker: true,
        locale: {

            format: 'DD/MM/YYYY'
        }
    });

    $('.inputTime').pickatime({
        format: 'H:i',
        formatSubmit: 'H:i',
        clear: 'Sterge'
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

    //    (function () {
    //        if (navigator.geolocation) {
    //            navigator.geolocation.getCurrentPosition(function (params) {
    //                $('.startLatitude').val(params.coords.latitude);
    //                $('.startLongitude').val(params.coords.longitude);
    //            });
    //        }
    //    })();


    //    $('form').form2();

</script>

@endpush