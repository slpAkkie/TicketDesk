@extends('templates.dashboard')

@section('main-content')
    <h2 class="font-bold text-xl">Statistic</h2>
    <ul class="mt-2">
        <li><b>Total tickets:</b> {{ $total }}</li>
        <li><b>Closed tickets:</b> {{ $closed }}</li>
        <li><b>Tickets in work:</b> {{ $inWork }}</li>
        <li><b>Tickets waiting to accept:</b> {{ $waiting }}</li>
    </ul>
@endsection
