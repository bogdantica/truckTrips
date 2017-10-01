<div class="placeContainer">
    <div class="row" style="{{ ($remove ?? false) ? '' : 'display:none;' }}">
        <div class="col-xs-12">
            <button type="button" class="btn btn-danger pull-right deletePlaceAction"
                    data-target-id="{{ $point->id ?? 'currentIndex' }}">
                Sterge
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group  has-feedback has-feedback-left">
                <label>Cauta Adresa</label>
                {!! Form::text('', null,['class' => 'form-control  placeInput', 'data-placeholder' => 'Cauta Adresa']) !!}
                <div class="form-control-feedback">
                    <i class="glyphicon glyphicon-map-marker"></i>
                </div>
            </div>
        </div>

        <div class="col-xs-12  col-md-4">
            <div class="form-group has-feedback has-feedback-left">
                <label>Strada</label>
                {!! Form::text($inputPrefix . '[address][street]',($point->address->street ?? false ),['class' => 'form-control ', 'placeholder' => 'Strada']) !!}
                <div class="form-control-feedback">
                    <i class="glyphicon glyphicon-road"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-2">
            <div class="form-group  has-feedback has-feedback-left">
                <label>Numar</label>
                {!! Form::text($inputPrefix . '[address][number]',($point->address->number ?? null ),['class' => 'form-control ', 'placeholder' => 'Numar']) !!}
                <div class="form-control-feedback">
                    <i class="fa fa-hashtag"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group  has-feedback has-feedback-left">
                <label>Localitate</label>
                {!! Form::text($inputPrefix . '[address][locality]',($point->address->locality ?? null ),['class' => 'form-control ', 'placeholder' => 'Localitate']) !!}
                <div class="form-control-feedback">
                    <i class="icon-traffic-lights"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Judet</label>
                {!! Form::text($inputPrefix . '[address][county]',($point->address->county ?? null ),['class' => 'form-control ', 'placeholder' => 'Judet']) !!}
                <div class="form-control-feedback">
                    <i class="fa fa-exchange"></i>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-md-4">
            <div class="form-group has-feedback has-feedback-left">
                <label>Tara</label>
                {!! Form::text($inputPrefix . '[address][country]',($point->address->country ?? null ),['class' => 'form-control ', 'placeholder' => 'Tara']) !!}
                <div class="form-control-feedback">
                    <i class="glyphicon glyphicon-flag"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Data</label>
                {!! Form::text($inputPrefix . '[schedule_date]',($point->schedule_date ?? false ) ? $point->schedule_date->format('d/m/Y') : null,['class' => 'form-control  inputDate', 'placeholder' => 'Data Incarcare']) !!}
                <div class="form-control-feedback">
                    <i class="glyphicon glyphicon-calendar"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Ora</label>
                {!! Form::text($inputPrefix . '[schedule_time]',($point->schedule_time ?? false ) ? $point->schedule_time->format('H:i') : null,['class' => 'form-control  inputTime', 'placeholder' => 'Ora Incarcare']) !!}
                <div class="form-control-feedback">
                    <i class="glyphicon glyphicon-time"></i>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Greutate Totala - KG</label>
                {!! Form::text($inputPrefix . '[cargo_weight]',$point->cargo_weight ?? null,['class' => 'form-control  ', 'placeholder' => 'Greutate KG']) !!}
                <div class="form-control-feedback">
                    <i class="icon-balance"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Volum Total - M<sup>3</sup></label>
                {!! Form::text($inputPrefix . '[cargo_volume]',$point->cargo_volume ?? null,['class' => 'form-control ', 'placeholder' => 'Volumn M3']) !!}
                <div class="form-control-feedback">
                    <i class=" icon-rulers"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Detalii</label>
        {{ Form::textarea($inputPrefix . '[details]',$point->details ?? null,['class' => 'form-control ','rows' => 4]) }}
    </div>

    <legend class="text-bold"></legend>
</div>

