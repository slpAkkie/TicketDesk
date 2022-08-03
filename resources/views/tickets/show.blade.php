@extends('templates.main')

@section('title', 'Ticket conversation ')

@section('content')
    <div class="grid gap-4 grid-cols-1 md:grid-cols-[1fr_400px]">
        <div>
            {{-- TODO: Conversation here... --}}
        </div>
        <div class="relative">
            <div class="md:sticky top-10">
                <div class="bg-blue-500 rounded-t-lg text-slate-50 py-2 px-4">
                    <h4 class="font-bold text-lg first-letter:uppercase">{{ $ticket->title }}</h4>
                </div>
                <div class="flex flex-col gap-2 bg-blue-100 rounded-b-lg border border-blue-500 py-4 px-4">
                    <p><b>Code:</b> {{ $ticket->code }}</p>
                    <p><b>Name:</b> {{ $ticket->name }}</p>
                    <p><b>Email:</b> {{ $ticket->email }}</p>
                    <p><b>Category:</b> {{ $ticket->category->title }}</p>
                    <p><b>Description:</b> {{ $ticket->description }}</p>
                    <p><b>Created at:</b> {{ $ticket->created_at }}</p>
                    <p><b>last activity:</b> {{ $ticket->updated_at }}</p>
                    <p><b>Status:</b> {{ $ticket->status->title }}</p>
                    <div>
                        @if ($ticket->status->slug !== 'closed')
                            <form action="{{ route('tickets.close', $ticket) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="submit" class="button" value="Close ticket">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
