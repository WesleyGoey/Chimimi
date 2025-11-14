<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
</head>

<body>
    @php
        $isAdmin = auth()->check() && auth()->user()->status === 'admin';
    @endphp

    @if ($isAdmin && request()->is('admin/*'))
        @include('layout.admin-navigation')
    @elseif ($isAdmin && !request()->is('admin/*'))
        @include('layout.admin-navigation')
    @else
        @include('layout.navigation')
    @endif

    <div>
        @yield('content')
    </div>

    @if (!($isAdmin && request()->is('admin/*')))
        @include('layout.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
