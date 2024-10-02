<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="Moto Care">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/icons/themify-icons/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/app.min.css')}} " type="text/css">

    {{-- @vite(['resources/js/app.js']) --}}

</head>
<body class="dark auth">
    @yield('auth-content')
</body>
</html>

