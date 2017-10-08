<div class="row labels">
    <div class="col-md-3">
        <div class=" has-feedback has-feedback-left required">
            <label>Serviciu Nou</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class=" has-feedback has-feedback-left required">
            <label>Cantitate</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="has-feedback has-feedback-left required">
            <label>Pret</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group has-feedback has-feedback-left required">
            <label>Total</label>
        </div>
    </div>
</div>

<div class="row newService serviceItem" data-service-index="0">
    <div class="col-md-3">
        <div class="form-group has-feedback has-feedback-left ">
            {!! Form::text('services[new][currentIndex][name]','',['class' => 'form-control ', 'placeholder' => 'Serviciu/Produs']) !!}
            <div class="form-control-feedback">
                <i class="icon-pencil3"></i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group has-feedback has-feedback-left ">
            {!! Form::number('services[new][currentIndex][quantity]','',['class' => 'form-control ', 'placeholder' => 'Cantitate']) !!}
            <div class="form-control-feedback">
                <i class=" icon-balance"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group has-feedback has-feedback-left ">
            {!! Form::number('services[new][currentIndex][price]','',['class' => 'form-control ', 'placeholder' => 'Pret']) !!}
            <div class="form-control-feedback">
                <i class="icon-coin-euro"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group input-group has-feedback has-feedback-left">
            {!! Form::number('services[new][currentIndex][total]','',['class' => 'form-control ', 'placeholder' => 'Total']) !!}
            <div class="form-control-feedback">
                <i class="icon-coins"></i>
            </div>
            <div class="input-group-btn">
                <button type="button" class="btn btn-primary newServiceAction" data-service-index="0"
                        data-popup="popover" data-trigger="hover" data-placement="top"
                        data-content="Adauga in Comanda"
                >
                    <i class="glyphicon glyphicon-plus"></i>
                </button>
                <button type="button" class="btn bg-danger-300 clearServiceAction"
                        data-popup="popover" data-trigger="hover" data-placement="top"
                        data-content="Goleste campurile">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </button>
                <button type="button" class="btn btn-danger deleteServiceAction" style="display:none"
                        data-service-index="0"
                        data-popup="popover" data-trigger="hover" data-placement="top"
                        data-content="Sterge din Comanda">
                    <i class="icon-calculator3 position-left"></i>
                    Sterge
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row labels header">
    <div class="col-md-3">
        <div class=" has-feedback has-feedback-left required">
            <label>Serviciu</label>
        </div>
    </div>
    <div class="col-md-2">
        <div class=" has-feedback has-feedback-left required">
            <label>Cantitate</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class=" has-feedback has-feedback-left required">
            <label>Pret</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" input-group has-feedback has-feedback-left required">
            <label>Total</label>
        </div>
    </div>
</div>

<div class="tripServicesContainer">
    @foreach($services as $service)
        <div class="row oldService serviceItem" data-service-id="{{ $service->id }}">
            <div class="col-md-3">
                <div class="form-group has-feedback has-feedback-left ">
                    {!! Form::text('services[old]['.$service->id.'][name]',$service->name,['class' => 'form-control ', 'placeholder' => 'Serviciu/Produs']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-pencil3"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group has-feedback has-feedback-left ">
                    {!! Form::number('services[old]['.$service->id.'][quantity]',$service->quantity,['class' => 'form-control ', 'placeholder' => 'Cantitate']) !!}
                    <div class="form-control-feedback">
                        <i class=" icon-balance"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback has-feedback-left ">
                    {!! Form::number('services[old]['.$service->id.'][price]',$service->price,['class' => 'form-control ', 'placeholder' => 'Pret']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-coin-euro"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group input-group has-feedback has-feedback-left">
                    {!! Form::number('services[old]['.$service->id.'][total]',$service->quantity * $service->price,['class' => 'form-control ', 'placeholder' => 'Total']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-coins"></i>
                    </div>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger deleteServiceAction"
                                data-service-id="{{ $service->id }}"
                                data-service-index="0"
                                data-popup="popover" data-trigger="hover" data-placement="top"
                                data-content="Sterge din Comanda">
                            <i class="glyphicon glyphicon-remove-sign"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>