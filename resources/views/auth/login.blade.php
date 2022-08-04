@extends('templates.main')

@section('title', 'Login to the system panel')

@section('content')
    <div class="max-w-[500px] mx-auto">
        <form action="{{ route('login.try') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Your email:</label>
                <input class="input" type="email" name="email" id="email" placeholder="You email...">
                @error('email')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Your email:</label>
                <input class="input" type="password" name="password" id="password" placeholder="You password...">
                @error('password')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-group-row form-group-row_preserve-col">
                <input class="input" type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>
            <div class="form-group">
                <input class="button" type="submit" value="Sign in">
            </div>
        </form>
    </div>
@endsection
