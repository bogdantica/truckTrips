<div class="row" data="">
    <div class="col-md-3">
        <div class="form-group has-feedback has-feedback-left ">
            <label>Serviciu Nou</label>
            {!! Form::text('services[new][currentIndex][name]',null,['class' => 'form-control ', 'placeholder' => 'Serviciu/Produs']) !!}
            <div class="form-control-feedback">
                <i class="icon-pencil3"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group has-feedback has-feedback-left ">
            <label>Cantitate</label>
            {!! Form::text('services[new][currentIndex][quantity]',null,['class' => 'form-control ', 'placeholder' => 'Cantitate']) !!}
            <div class="form-control-feedback">
                <i class=" icon-balance"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group has-feedback has-feedback-left ">
            <label>Pret</label>
            {!! Form::text('services[new][currentIndex][price]',null,['class' => 'form-control ', 'placeholder' => 'Cantitate']) !!}
            <div class="form-control-feedback">
                <i class="icon-coin-euro"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group input-group has-feedback has-feedback-left">
            <label>Total</label>
            {!! Form::text('services[new][currentIndex][total]',null,['class' => 'form-control ', 'placeholder' => 'Total']) !!}
            <div class="form-control-feedback">
                <i class="icon-coins"></i>
            </div>
            <div class="input-group-btn">
                <button type="button" class="btn btn-warning">
                    <i class="icon-calculator3 position-left"></i>
                    Adauga
                </button>
            </div>

        </div>


        {{--<div class="form-group  ">--}}
        {{--<div class="form-control-feedback">--}}
        {{--<i class="icon-coins"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>


    {{--<div class="col-md-3 pull-right margin-bottom-md">--}}
    {{--<button type="button" class="btn btn-warning newTripPoint pull-right">--}}

    {{--</button>--}}
    {{--</div>--}}
</div>
<div class="tripServicesContainer">
    @foreach($services as $service)
    @endforeach
    <div class="row" data-service-id="{{ $service->id }}">
        <div class="col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Serviciu</label>
                {!! Form::text('services[old]['.$service->id.'][name]',$service->name,['class' => 'form-control ', 'placeholder' => 'Serviciu/Produs']) !!}
                <div class="form-control-feedback">
                    <i class="icon-pencil3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Cantitate</label>
                {!! Form::text('services[old]['.$service->id.'][quantity]',$service->quantity,['class' => 'form-control ', 'placeholder' => 'Cantitate']) !!}
                <div class="form-control-feedback">
                    <i class=" icon-balance"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group has-feedback has-feedback-left ">
                <label>Pret</label>
                {!! Form::text('services[old]['.$service->id.'][price]',$service->price,['class' => 'form-control ', 'placeholder' => 'Pret']) !!}
                <div class="form-control-feedback">
                    <i class="icon-coin-euro"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group input-group has-feedback has-feedback-left">
                <label>Total</label>
                {!! Form::text('services[old]['.$service->id.'][total]',$service->quantity * $service->price,['class' => 'form-control ', 'placeholder' => 'Total']) !!}
                <div class="form-control-feedback">
                    <i class="icon-coins"></i>
                </div>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger">
                        <i class="icon-calculator3 position-left"></i>
                        Sterge
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>