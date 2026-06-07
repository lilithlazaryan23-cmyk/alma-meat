<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="authed" content="{{ session('user_id') ? '1' : '0' }}">
    <title>@yield('title')</title>
    @yield('head')
        <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-sans-armenian/noto-sans-armenian.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-serif-armenian/noto-serif-armenian.css') }}">
    @vite('resources/css/polish.css')
</head>

<body>
@yield('body')
</body>

</html>
