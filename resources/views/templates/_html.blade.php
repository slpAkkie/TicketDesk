<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SEO --}}
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="og:description" content="{{ config('app.description') }}">
    <meta name="og:title" content="{{ config('app.name') }} - @yield('title', 'Ticket feedback system')">

    {{-- Vite assets --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    {{-- Title --}}
    <title>{{ config('app.name') }} - @yield('title', 'Ticket feedback system')</title>
</head>

<body class="antialiased min-h-screen bg-sky-50">
    @yield('body')
</body>

</html>
