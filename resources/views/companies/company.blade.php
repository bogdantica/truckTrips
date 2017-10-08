@extends('layouts.app')

@push('content')

<div class="panel panel-white newCompanyContainer">

    @php $route = empty($byOwner) ? route('companies.new') : route('companies.new.byOwner',['owner' => sha1(time()) ])  @endphp

    {!! Form::open(['url' => $route,'method' => ($company->id ?? false) ? 'PUT': 'POST']) !!}

    <div class="panel-heading">
        @if($byOwner)
            <h6 class="panel-title">Compania ta</h6>
        @else
            <h6 class="panel-title">Companie Noua</h6>
        @endif
    </div>

    <div class="panel-body">

        <fieldset class="companyContainer">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>CIF</label>
                        {{ Form::text('cif',$company->cif?? null,['class' => 'form-control companyCif','placeholder' => 'Cod Fiscal']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Denumire</label>
                        {{ Form::text('name',$company->name ?? null,['class' => 'form-control companyName','placeholder' => 'Denumire']) }}
                        <div class="form-control-feedback">
                            <i class="glyphicon glyphicon-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Nr Registrul Comertului</label>
                        {{ Form::text('reg_id',$company->reg_id?? null,['class' => 'form-control companyRegId','placeholder' => 'Numar Registrul Comertului']) }}
                        <div class="form-control-feedback">
                            <i class="icon-hash"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback has-feedback-left ">
                        <label>Address</label>
                        {{ Form::text('address',$company->address ?? null,['class' => 'form-control companyAddress','placeholder' => 'Adresa']) }}
                        <div class="form-control-feedback">
                            <i class="icon-location4"></i>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>


    </div>

    <div class="panel-footer pl-20 pr-20">
        <button type="submit" class="btn btn-success pull-right">Salveaza</button>
    </div>
    {!! Form::close() !!}
</div>
@endpush

@push('scripts')

<div class="newCompanyContainerScripts">
    <script>
        $('.companyCif').keyup(function () {

            var $this = $(this);
            var cif = $this.val();

            cif = cif.trim().toLowerCase().replace('ro', '');

            $this.val(cif);

            if (cif.length >= 8) {
                $this.prop('disabled', true);
            } else {
                return;
            }

            var $iconCont = $this.parent().find('.form-control-feedback');
            var $originalFeedBack = $iconCont.html();

            $.ajax({
                method: 'GET',
                url: '{{ route('companies.external') }}',
                data: {
                    cif: cif
                },
                beforeSend: function () {
                    $iconCont.html('<i class="icon-spinner9 spinner position-left"></i>');
                },

                success: function (data, x, y) {
                    if (data.cif) {
                        updateCompany(data);
                    } else {

                    }

                    enableInput();
                },
                errors: function (data, x, y) {
                    enableInput();
                    $this.prop('disabled', null);
                }
            });

            var updateCompany = function (comp) {
                var $cont = $('.companyContainer');
                $cont.find('.companyName').val(comp.name);
                $cont.find('.companyRegId').val(comp.registration_id);
                $cont.find('.companyAddress').val(comp.address);
                if (comp.vat == 1) {
                    $this.val('RO' + $this.val());
                }
            };

            var enableInput = function () {
                $iconCont.html($originalFeedBack);
                $this.prop('disabled', null);
            }

        });

        $('form').form2();
    </script>

</div>

@endpush