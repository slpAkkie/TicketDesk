<div class="flex flex-col gap-4">
    @if ($tickets->isEmpty())
        <h2 class="font-bold text-xl">There is no tickets</h2>
    @else
        @foreach ($tickets as $ticket)
            <x-ticket :t="$ticket" />
        @endforeach
    @endif
</div>

{{ $tickets->links() }}
