@extends('layouts.app')

@push('content')

<div class="panel panel-white newDriverContainer">
    {!! Form::open(['url' =>route('drivers.new'),'method' => ($user->id ?? false) ? 'PUT': 'POST']) !!}
    <div class="panel-heading">
        <h6 class="panel-title">Sofer Nou</h6>
    </div>

    <div class="panel-body">

        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Nume</label>
                        {{ Form::text('name',$user->name ?? null,['class' => 'form-control','placeholder' => 'Nume']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Email</label>
                        {{ Form::text('email',$user->email ?? null,['class' => 'form-control','placeholder' => 'Email']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Telefon</label>
                        {{ Form::text('phone',$user->phone ?? null,['class' => 'form-control','placeholder' => 'Telefon']) }}
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