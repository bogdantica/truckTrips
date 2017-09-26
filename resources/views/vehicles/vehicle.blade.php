@extends('layouts.app')

@push('content')

<div class="panel panel-white newVehicleContainer">
    {!! Form::open(['url' =>route('vehicles.new'),'method' => ($vehicle->id ?? false) ? 'PUT': 'POST']) !!}
    <div class="panel-heading">
        <h6 class="panel-title">Vehicul Nou</h6>
    </div>

    <div class="panel-body">

        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Numar Inmatriculare</label>
                        {{ Form::text('registration',$vehicle->registration ?? null,['class' => 'form-control','placeholder' => 'Numar Inmatriculare']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Marca/Model</label>
                        {{ Form::text('name',$vehicle->name ?? null,['class' => 'form-control','placeholder' => 'Marca/Model']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Serie VIN</label>
                        {{ Form::text('vin',$vehicle->vin ?? null,['class' => 'form-control','placeholder' => 'Serie VIN']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Masa Utila</label>
                        {{ Form::text('max_weight',$vehicle->vin ?? null,['class' => 'form-control','placeholder' => 'Masa Utila']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Serie VIN</label>
                        {{ Form::text('vin',$vehicle->vin ?? null,['class' => 'form-control','placeholder' => 'Serie VIN']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Tip</label>
                        {!! Form::select('vehicle_type_id',$types,$vehicle->vehicle_type_id,['class' => 'form-control vehicleTypeInput']) !!}
                        {{--{{ Form::text('vehicle_type_id',$vehicle->vehicle_type_id ?? null,['class' => 'form-control']) }}--}}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>

            </div>
        </fieldset>
    </div>
    <div class="panel-footer pl-20 pr-20">
        <button type="submit" class="btn btn-success pull-right">Salveaza</button>
    </div>
</div>

@endpush


@push('scripts')

<div class="newVehicleContainerScripts">
    <script>
        $('.newVehicleContainer .vehicleTypeInput').select2();
    </script>
</div>

@endpush