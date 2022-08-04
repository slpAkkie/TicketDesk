@extends('templates.dashboard')

@section('title', 'User profile')

@section('main-content')
    <h2 class="font-bold text-xl">User info</h2>
    <div class="mt-2">
        <h3 class="font-bold text-lg">{{ $user->name }}</h3>
        <p><b>Email:</b> {{ $user->email }}</p>
        <p><b>Role:</b> {{ $user->isSuper() ? 'Superuser' : ($user->isAdmin() ? 'Admin' : 'Common') }}</p>
    </div>
@endsection
