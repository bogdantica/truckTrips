<div class="A4-page">
    <div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title text-center">Comanda Transport
            #{{ $trip->id }} {{ format($trip->agreement_date,'d/m/Y') }}</h6>
        <div class="heading-elements hidePrint">
            <a href="{{ route('trips.view',['trip' => $trip->id,'pdf']) }}"
               onclick="window.print()"
               class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i>
                Printeaza
            </a>
        </div>
    </div>

        <div class="panel-body no-padding-bottom no-padding-top">
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 pb-10 pt-10 companyHeader">
                @include('trips.view.company',['company' => $trip->transporter,'title' => 'Transportator'])
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6 text-right pb-10 pt-10 companyHeader">
                @include('trips.view.company',['company' => $trip->beneficiary,'title' => 'Beneficiar'])
            </div>

            {{--<div class="col-md-6 col-lg-3 content-group">--}}
            {{--<span class="text-muted">Payment Details:</span>--}}
            {{--<ul class="list-condensed list-unstyled invoice-payment-details">--}}
            {{--<li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>--}}
            {{--<li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>--}}
            {{--<li>Country: <span>United Kingdom</span></li>--}}
            {{--<li>City: <span>London E1 8BF</span></li>--}}
            {{--<li>Address: <span>3 Goodman Street</span></li>--}}
            {{--<li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>--}}
            {{--<li>SWIFT code: <span class="text-semibold">BPT4E</span></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
        </div>
            <div class="row">
                <div class="col-sm-6 pb-5">
                    <ul class="list-condensed list-unstyled">
                        <li>Auto: <span
                                    class="text-semibold">{{ $trip->vehicles ? $trip->vehicles->pluck('registration')->implode(' / ') : null }}</span>
                        </li>
                        <li>Tip: <span
                                    class="text-semibold">{{ $trip->vehicles ? $trip->vehicles->pluck('type.name')->implode(' / ') : null }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 text-right pb-5">
                    <ul class="list-condensed list-unstyled">
                        <li>Sofer: <span class="text-semibold">{{ $trip->driver->name }} </span></li>
                        <li><span class="text-semibold">{{ $trip->driver->phone }} </span></li>
                        {{--<li>Ruta: <span class="text-semibold">Bucuresti, Rosiori, Craiova</span></li>--}}
                    </ul>
                </div>

            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-lg">
            <thead>
            <tr>
                <th>Incarcare/Descarcare</th>
                <th>Adresa</th>
                <th>Marfa</th>
            </tr>
            </thead>
            <tbody>

            @include('trips.view.point',['point' => $trip->startPoint ])

            @foreach($trip->points as $point)
                @include('trips.view.point',['point' => $point ])
            @endforeach

            @include('trips.view.point',['point' => $trip->endPoint ])

            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
        @if($trip->services->count())
        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                <tr>
                    <th>Serviciu</th>
                    <th>Cantitate</th>
                    <th>Pret</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trip->services as $service)
                    @include('trips.view.service',['service' => $service])
                @endforeach
                </tbody>
            </table>
        </div>
        @endif

    <div class="panel-body">
        @if($trip->services->count())
        <div class="row invoice-payment">
            <div class="col-xs-7">
                <div class="content-group">
                    {{--<h6>Authorized person</h6>--}}
                    {{--<div class="mb-15 mt-15">--}}
                    {{--<img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">--}}
                    {{--</div>--}}

                    @if($trip->payMethod)
                        <ul class="list-condensed list-unstyled ">
                            <li><span class="text-semibold">Metoda de Plata:</span> <span
                                        class=" text-muted">{{ $trip->payMethod->name }}</span>
                            </li>
                            <li><span class="text-semibold">Data Platii:</span> <span
                                        class=" text-muted">{{ format($trip->pay_date,'d/m/Y') }}</span>
                            </li>
                    </ul>
                    @endif
                    @if($trip->pay_details)
                        <div class="text-muted">
                            {{ $trip->pay_details }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xs-3 pull-right">
                <div class="content-group">
                    {{--<h6>Total due</h6>--}}
                    <div class="table-responsive no-border">
                        <table class="table">
                            <tbody>
                            @if($trip->vat_id)
                                <tr>
                                    <th class="b-t-0">Subtotal:</th>
                                    <td class="text-right b-t-0">$7,000</td>
                                </tr>
                                <tr>
                                    <th>TVA: <span class="text-regular">19%</span></th>
                                    <td class="text-right">$1,750</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="text-semibold">{{ $trip->total_price }}
                                        RON</h5></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        @endif
        <div class="row pb-30">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <p class="text-bold">Transportator</p>
                Stampila/Sematura
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                <p class="text-bold">Beneficiar</p>
                Stampila/Sematura
            </div>
        </div>

        {{--<h6>Other information</h6>--}}
        {{--<p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill--}}
        {{--or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with--}}
        {{--with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman--}}
        {{--Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>--}}
    </div>
    </div>
</div>