<span class="text-muted">{{ $title }}:</span>
<ul class="list-condensed list-unstyled">
    <li><h5>{{ $trip->transporter->name }}</h5></li>
    {{--<li><span class="text-semibold">Normand axis LTD</span></li>--}}
    <li><span class="text-semibold">{{ $company->cif }}</span></li>
    <li><span class="text-semibold">{{ $company->reg_id }}</span></li>
    <li>Adresa:</li>
    <li><span class="text-semibold">{{ $company->address }}</span></li>
    {{--<li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>--}}

</ul>