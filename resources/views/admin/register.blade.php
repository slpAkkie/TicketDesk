@extends('templates.dashboard')

@section('title', 'Create new user')

@section('main-content')
    <div class="max-w-[500px]">
        <form action="{{ route('register.try') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input class="input" type="text" name="name" id="name" placeholder="Name...">
                @error('name')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input class="input" type="email" name="email" id="email" placeholder="Email...">
                @error('email')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input class="input" type="password" name="password" id="password" placeholder="Password...">
                @error('password')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Repeat password:</label>
                <input class="input" type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Repeat password...">
            </div>
            @if (Auth::user()->isSuper())
                <div class="form-group form-group-row form-group-row_preserve-col">
                    <input class="input" type="checkbox" name="admin" id="admin">
                    <label for="admin">Give admin access rights</label>
                </div>
            @endif
            <div class="form-group">
                <input class="button" type="submit" value="Register">
            </div>
        </form>
    </div>
@endsection
