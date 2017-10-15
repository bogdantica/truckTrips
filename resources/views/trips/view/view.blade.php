@extends('layouts.app')

@push('content')

<div class="trip-view-print {{ $pdf ? 'trip-view-pdf' : null }}">

    @include('trips.view.content')
    
</div>

@endpush