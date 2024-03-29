@extends('layouts.app')

@push('content')

<div class="panel panel-white">

    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h6 class="panel-title">Cursa Noua </h6>
            </div>
            <div class="col-xs-12 col-sm-6">
                <h6 class="panel-title pull-right">{{ $company->name }}</h6>
            </div>
        </div>
    </div>
    {!! Form::open([
    'url' => $trip->id ? route('trips.edit',['trip' => $trip->id]) : route('trips.new'),
    'method' => $trip->id ? 'PUT' : 'POST',
    'class' => 'steps-basic',
     'id' => 'form' . '-'. ($trip->id ?? 'new-company-' .$company->id )
    ]) !!}

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
                        {{ Form::select('beneficiary_company_id',$companies,$trip->receiver_company_id ?? null,['class' => 'companyInput form-control']) }}
                        <div class="form-control-feedback">
                            <i class="icon-office"></i>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success newCompanyAction"
                                    data-popup="popover" data-trigger="hover" data-placement="top"
                                    data-content="Adauga o noua Companie"
                            >
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group input-group required vehicleContainer ">
                        <label>Vehicule</label>
                        {{ Form::select('vehicles[]',$vehicles,null,['class' => 'form-control vehiclesInput','multiple']) }}
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success newVehicleAction"
                                    data-popup="popover" data-trigger="hover" data-placement="top"
                                    data-content="Adauga un nou Vehicul">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group input-group driverContainer">
                        <label>Sofer</label>
                        {{ Form::select('driver_user_id',$drivers,$trip->driver_user_id ?? null,['class' => 'select form-control']) }}
                        <div class="input-group-btn">
                            <button type="button" class="btn bg-success newDriverAction"
                                    data-popup="popover" data-trigger="hover" data-placement="top"
                                    data-content="Adauga un nou Sofer">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

    <h6>Incarcare</h6>
    <fieldset data-map="true">
        <div class="loadPlace">
            @include('trips.elements.point',['inputPrefix' => 'startPoint','point' => $trip->startPoint])
        </div>
    </fieldset>

    <h6>Puncte Aditionale</h6>
    <fieldset data-map="true">
        <div class="placesContainer">

            <div class="newPointModel">
                <div class="row">
                    <div class="col-xs-12 pb-5">
                        <div class="btn-group pull-right sticky">
                            <button type="button" class="btn btn-primary newPlaceAction"
                                    data-popup="popover" data-trigger="hover" data-placement="top"
                                    data-content="Salveaza Punctul Aditional">
                                <i class="glyphicon glyphicon-plus position-left"></i>
                                Adauga
                            </button>
                            <button type="button" class="btn bg-danger-300 clearPlaceAction"
                                    data-popup="popover" data-trigger="hover" data-placement="bottom"
                                    data-title="Sterge Datele din formular"
                                    data-content="Daca sunt data in formular nesalvate, nu poti trece mai departe."
                            >
                                <i class="glyphicon glyphicon-remove-sign"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @include('trips.elements.point',['inputPrefix' => 'point[new][currentIndex]','point' => null])
            </div>
            <div class="tripPlacesContainer">
            @foreach($trip->points as $point)

                @include('trips.elements.point',['inputPrefix' => 'point[old]['.$point->id.']','point' => $point,'remove' => true])

            @endforeach
            </div>
        </div>
    </fieldset>

    <h6>Descarcare</h6>
    <fieldset data-map="true">
            <div class="unLoadPlace">
                @include('trips.elements.point',['inputPrefix' => 'endPoint','point' => $trip->endPoint])
            </div>
        </fieldset>

        <h6>Tarife</h6>
        <fieldset>
            <div class="servicesContainer">
                @include('trips.elements.services',['services' => $trip->services])
            </div>
        </fieldset>

    <h6>Plata</h6>
    <fieldset>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback has-feedback-left">
                    <label>Metoda de Plata</label>
                    {{ Form::select('pay_method_id',$payMethods,$trip->pay_method_id,['class' => 'form-control select','placeholder' => 'Metoda de Plata','data-placeholder' => 'Metoda de Plata','data-allow-clear' => 'true',]) }}
                    <div class="form-control-feedback">
                        <i class="icon-coin-euro"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback has-feedback-left">
                    <label>Data Platii</label>
                    {{ Form::text('pay_date',$trip->pay_day ? $trip->pay_day->format('d/m/Y') : null,['class' => 'form-control inputDate','data-placeholder' => 'Data Platii']) }}
                    <div class="form-control-feedback">
                        <i class="icon-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Detalii Plata</label>
                    {!! Form::textarea('pay_details',$trip->pay_details,['class' => 'form-control','placeholder' => 'Detalii Plata','rows' => 4,]) !!}
                </div>
            </div>

        </div>

    </fieldset>

    <h6>Contract Comanda</h6>
    <fieldset class="pb-10">
        {{ Form::textarea('agreement',$trip->agreement ?? null,['class' => 'agreementBody form-control','rows' => 5,'id' => 'agreement']) }}
    </fieldset>

    {!! Form::close() !!}

</div>

{{--<div class="panel panel-white"--}}
     {{--style="display: none"--}}
{{-->--}}

{{--<div class="panel-body">--}}
{{--<div class="map-container">--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}

@endpush

@push('scripts')

<script>

    $('form').steps({
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
        },
        onStepChanging: function (e, currentIndex, newIndex) {
            var $form = $(this);

            //todo add jqeury validation on each section !

            if (currentIndex == 2 && newIndex > currentIndex) {
                var clear = true;
                $form.find('[name^="point[new][currentIndex]"]:not([name="point[new][currentIndex][schedule_date]"])').each(function () {
                    var $this = $(this);
                    if ($this.val() != "") {
                        clear = false;

                        var $group = $this.closest('.form-group');
                        $group.addClass('animated').addClass('tada')
                        setTimeout(function () {
                            $group.removeClass('tada').removeClass('animated')
                        }, 1000);
                    }
                });

                if (!clear) {

                    var $placeAction = $form.find('.newPlaceAction');
                    var $clearPlaceAction = $form.find('.clearPlaceAction');
                    $placeAction.addClass('animated').addClass('rubberBand');
                    $clearPlaceAction.addClass('animated').addClass('flash');


                    setTimeout(function () {
                        $placeAction
                            .removeClass('animated').removeClass('rubberBand');
                        $clearPlaceAction.removeClass('animated').removeClass('flash');

                    }, 1000);

                    return false;
                }

            }

            if (currentIndex == 4 && newIndex > currentIndex) {
                clear = true;
                $form.find('[name^="services[new][currentIndex]"]').each(function () {
                    var $this = $(this);
                    if ($this.val() != "") {
                        clear = false;

                        var $group = $this.closest('.form-group');
                        $group.addClass('animated').addClass('tada');
                        setTimeout(function () {
                            $group.removeClass('tada').removeClass('animated');
                        }, 1000);
                    }
                });

                if (!clear) {
                    var $serviceAction = $form.find('.newServiceAction');
                    var $clearServiceAction = $form.find('.clearServiceAction');

                    $serviceAction.addClass('animated').addClass('rubberBand');
                    $clearServiceAction.addClass('animated').addClass('flash');

                    setTimeout(function () {
                        $clearServiceAction.removeClass('animated').removeClass('flash');
                        $serviceAction
                            .removeClass('animated').removeClass('rubberBand');

                    }, 1000);

                    return false;
                }
            }

            var formId = $form.prop('id');

            var $container = $form.find('#' + formId + '-p-' + currentIndex);
            var haveMap = $container.attr('data-map') == 'true';

            if (haveMap) {
//                $('.map-wrapper').show();
            } else {
//                $('.map-wrapper').hide();
            }

            return true;
        }

    })
        .form2({
            steps: true,
            ignoreInputs: [
                '[currentIndex]'
            ]
        });

    $('.companyContainer .newCompanyAction').modalView({
        elementSelector: '.newCompanyContainer',
        url: '{{ route('companies.new') }}'
    });

    $('.driverContainer .newDriverAction').modalView({
        elementSelector: '.newDriverContainer',
        url: '{{ route('drivers.new') }}'
    });

    $('.vehicleContainer .newVehicleAction').modalView({
        text: 'registration',
        elementSelector: '.newVehicleContainer',
        url: '{{ route('vehicles.new') }}'
    });

    $('.placeInput').gooAutComp();
    //    $('.map-container').gooMaps();

    $('.vehiclesInput').select2({
        tags: true,
        multiple: true,
    });


    $("select:not([class^=\"select2\"])").select2();

    $('.inputDate').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });

    $('.inputTime').pickatime({
        format: 'HH:i',
        formatSubmit: 'HH:i',
        clear: 'Sterge'
    });

    $('.newService,.oldService').services();

    CKEDITOR.replace($('.agreementBody')[0]).on('instanceReady', CKEDitorChangeHook);

    $('.newPointModel').places();

</script>

@endpush