@extends('templates.main')

@section('title', 'Ticket conversation ')

@section('content')
    {{-- Main block --}}
    <div class="grid gap-5 grid-cols-1 md:grid-cols-[1fr_400px]">
        <div class="flex flex-col gap-5">
            {{-- New message form --}}
            @if (!$ticket->isClosed())
                <form action="{{ route('tickets.messages.store', $ticket) }}" method="post"
                    class="border border-blue-200 rounded-lg overflow-hidden">
                    @csrf
                    <textarea class="block w-full border-0 p-4" name="content" id="content" cols="30" rows="5"
                        placeholder="Message..."></textarea>
                    <div class="flex gap-4 bg-blue-200 text-slate-50 px-4 py-2">
                        <div class="grow"></div>
                        <input class="button" type="submit" value="Send">
                    </div>
                </form>
            @endif

            {{-- Converstion history --}}
            <div class="flex flex-col gap-4">
                <h2 class="font-bold text-xl">Conversation</h2>

                @foreach ($messages as $message)
                    <div class="w-fit max-w-[80%] [ @if ($message->user) mr-0 ml-auto text-right @endif ]">
                        <div
                            class="rounded-lg p-5 [ @if ($message->user) bg-blue-500 text-slate-50 @else bg-blue-100 @endif ]">
                            <h4 class="font-bold text-md">{{ $message->user ? $message->user->name : $ticket->name }}</h4>
                            <p>{{ $message->content }}</p>
                        </div>
                        <p class="mt-3 text-sm text-slate-400">{{ $message->created_at }}</p>
                    </div>
                @endforeach
            </div>

            {{ $messages->links() }}
        </div>

        {{-- Sidebar --}}
        <div class="relative">
            <div class="md:sticky top-10">
                <div class="bg-blue-500 rounded-t-lg text-slate-50 py-2 px-4">
                    <h3 class="font-bold text-lg first-letter:uppercase">{{ $ticket->title }}</h3>
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
                        @if (!$ticket->isClosed() && $ticket->canClose())
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
