@extends('templates.main')

@section('title', 'Dashboard')

@section('content')
    <div class="grid gap-8 grid-cols-1 md:grid-cols-[350px_1fr]">
        <aside class="relative">
            <div class="md:sticky top-10">
                <div class="bg-blue-500 rounded-t-lg text-slate-50 py-2 px-4">
                    <h3 class="font-bold text-lg">Sections</h3>
                </div>
                <div class="flex flex-col gap-4 bg-blue-100 rounded-b-lg border border-blue-500 py-4 px-4">
                    <section>
                        <h3 class="font-bold text-xl">User</h3>
                        <ul class="list">
                            <li><a class="link" href="{{ route('users.profile', Auth::user()) }}">Profile</a></li>
                        </ul>
                    </section>
                    @if (Auth::user()->isAdmin())
                        <section>
                            <h3 class="font-bold text-xl">Admin</h3>
                            <ul class="list">
                                <li><a class="link" href="{{ route('register') }}">Create user</a></li>
                                <li><a class="link" href="{{ route('users.index') }}">Users</a></li>
                            </ul>
                        </section>
                    @endif
                    <section>
                        <h3 class="font-bold text-xl">Tickets</h3>
                        <ul class="list">
                            <li><a class="link" href="{{ route('tickets.index.accepted-by-autorized-user') }}">I'm
                                    responsible</a></li>
                            <li><a class="link" href="{{ route('tickets.index.not-accepted') }}">Waiting</a></li>

                            @if (Auth::user()->isAdmin())
                                <li><a class="link" href="{{ route('tickets.index.all-accepted') }}">All accepted
                                        tickets</a></li>
                                <li><a class="link" href="{{ route('tickets.index.closed') }}">Closed tickets</a></li>
                            @endif
                        </ul>
                    </section>
                </div>
            </div>
        </aside>
        <main>
            @yield('main-content')
        </main>
    </div>
@endsection
