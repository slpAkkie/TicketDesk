@extends('templates.dashboard')

@section('title', isset($title) ? $title : null)

@section('main-content')
    <x-ticket-listing :tickets="$tickets" />
@endsection
