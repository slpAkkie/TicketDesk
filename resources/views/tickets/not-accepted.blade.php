@extends('templates.dashboard')

@section('title', 'Not accepted tickets')

@section('main-content')
    <div class="flex flex-col gap-4">
        @if ($tickets->empty())
            <h2 class="font-bold text-xl">No tickets available</h2>
        @else
            @foreach ($tickets as $ticket)
                <x-ticket :t="$ticket" />
            @endforeach
        @endif
    </div>
@endsection
