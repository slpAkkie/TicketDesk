@extends('templates._html')

@section('body')
    <x-header />

    <div class="container mx-auto px-2 md:px-5 py-10">
        @yield('content')
    </div>

    <x-footer />
@endsection
