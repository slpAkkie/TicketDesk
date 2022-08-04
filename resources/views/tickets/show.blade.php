@extends('templates.main')

@section('title', 'Ticket conversation ')

@section('content')
    {{-- Main block --}}
    <div class="grid gap-8 grid-cols-1 md:grid-cols-[1fr_400px]">
        <div class="flex flex-col gap-5 order-2 md:order-1">
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
        <aside class="relative order-1 md:order-2">
            <div class="md:sticky top-10">
                <div class="bg-blue-500 rounded-t-lg text-slate-50 py-2 px-4">
                    <h3 class="font-bold text-lg first-letter:uppercase">{{ $ticket->title }}</h3>
                </div>
                <div class="flex flex-col gap-2 bg-blue-100 rounded-b-lg border border-blue-500 py-4 px-4">
                    <ul>
                        <li><b>Code:</b> {{ $ticket->code }}</li>
                        <li><b>Name:</b> {{ $ticket->name }}</li>
                        <li><b>Email:</b> {{ $ticket->email }}</li>
                        <li><b>Category:</b> {{ $ticket->category->title }}</li>
                        <li><b>Description:</b> {{ $ticket->description }}</li>
                        <li><b>Created at:</b> {{ $ticket->created_at }}</li>
                        <li><b>last activity:</b> {{ $ticket->updated_at }}</li>
                        <li><b>Status:</b> {{ $ticket->status->title }}</li>
                    </ul>
                    @if (!$ticket->isClosed() && $ticket->canClose())
                        <form action="{{ route('tickets.close', $ticket) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="submit" class="button" value="Close ticket">
                        </form>
                    @endif
                </div>
                <div class="mt-4">
                    <h2 class="font-bold text-xl">Attachments</h2>
                    <div class="flex flex-col gap-2">
                        <ul class="list">
                            @foreach ($attachments as $attachment)
                                <li>
                                    <a class="link" href="{{ asset('storage/' . $attachment->path) }}"
                                        target="_blank">{{ $attachment->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form class="mt-2" action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <input class="input_file" type="file" name="attachments[]" id="attachments" multiple>
                            <p class="text-red-500">
                                @error('attachments')
                                    {{ $message }}
                                @enderror
                            </p>
                            <input class="button mt-2" type="submit" value="Attach">
                        </div>
                    </form>
                </div>
            </div>
        </aside>
    </div>
@endsection
