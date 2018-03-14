<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('/public/js/app.js') }}"></script>
    @yield( 'custom-scripts' )

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            @include('layouts.nav')
        </nav>
        @include('layouts.alerts')
        @yield('content')
    </div>
</body>
<footer>
    @yield('footer')
</footer>
</html>
