<nav class="py-4 bg-slate-700 text-slate-50">
    <div class="container mx-auto px-2 md:px-5">
        <div class="flex gap-4 justify-between items-center">
            <h1 class="font-bold text-2xl"><a
                    href="{{ !is_null(auth()->user()) ? route('dashboard') : route('tickets.create') }}">{{ config('app.name') }}</a>
            </h1>
            <div class="flex gap-4 items-center uppercase">
                @auth
                    <a class="link" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="link" href="{{ route('logout') }}">Logout</a>
                @else
                    <a class="link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
