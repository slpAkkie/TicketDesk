@extends('templates.dashboard')

@section('title', 'Users')

@section('main-content')
    <div class="flex flex-col gap-4">
        @if ($users->isEmpty())
            <h2 class="font-bold text-xl">There is no other users</h2>
        @else
            <ul class="list">
                @foreach ($users as $user)
                    <li class="font-bold"><a class="link" href="#">{{ $user->name }} @if ($user->isAdmin())
                                <span class="font-normal text-slate-400">(Admin)</span>
                            @endif
                        </a></li>
                @endforeach
            </ul>
        @endif
    </div>

    {{ $users->links() }}
@endsection
