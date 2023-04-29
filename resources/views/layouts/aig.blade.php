<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} | @yield('title')</title>
    <link rel="icon" href="{{asset('img/icon.png')}}" type="image/png" sizes="16x16">
    @include('layouts.menu_css')
</head>

<body class="hold-transition login-page">
    <div>
        @yield('content')
    </div>
    @include('layouts.menu_js')
    @yield('javascript')
</body>

</html>