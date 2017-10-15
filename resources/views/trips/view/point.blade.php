<tr>
    <td>
        <div class="media-left">
            <div class="text-default text-semibold">{{ $point->address_locality }}</div>
            <div class="text-muted text-size-small">
                <span class="status-mark border-blue position-left"></span>
                {{ format($point->schedule_date,"d/m/Y") }} {{ format($point->schedule_date,"H:i")  }}
            </div>
        </div>
    </td>
    <td class="text-muted">
        <p>{{ $point->address_street }} {{ $point->address_number }}</p>
        <p>{{ $point->address_locality }} {{ $point->address_county }} {{ $point->address_country }}</p>
    </td>
    <td class="text-muted">
        @if($point->cargo_weight)
            <p>
                {{ $point->cargo_weight ?? '-' }} t
            </p>
        @endif
        @if($point->cargo_volume)
            <p>
                {{ $point->cargo_volume }} M<sup>3</sup>
            </p>
        @endif
    </td>
</tr>
@if($point->details)
    <tr>
        <td colspan="3" class="b-t-0"><span class="text-muted">$point->details</span></td>
    </tr>
@endif