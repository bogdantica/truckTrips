<tr class="text-muted text-semibold">
    <td>{{ $service->name }}</td>
    <td>{{ number_format($service->quantity,1) }}
        <span class="pull-right"> x </span>
    </td>
    <td>{{ number_format($service->price,2) }}
        <span class="pull-right"> = </span>
    </td>
    <td>{{ number_format($service->total,2) }}</td>
</tr>