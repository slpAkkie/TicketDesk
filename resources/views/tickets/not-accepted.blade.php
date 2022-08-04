@extends('templates.dashboard')

@section('title', 'Not accepted tickets')

@section('main-content')
    <x-ticket-listing :tickets="$tickets" placeholder="No tickets available" />
@endsection
