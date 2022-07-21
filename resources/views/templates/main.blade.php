@extends('templates._html')

@section('body')
    <x-header />

    @yield('content')

    <x-footer />
@endsection
