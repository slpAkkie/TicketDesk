@extends('templates.dashboard')

@section('title', 'Ticket accepted by me')

@section('main-content')
    <x-ticket-listing :tickets="$tickets" />
@endsection
