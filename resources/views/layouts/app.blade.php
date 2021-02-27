<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ asset('./img/stethoscope-solid.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>
    <link rel="stylesheet" href="{{ asset ('css/app.css')}}">

</head>
<body>
    <div id="app">
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    

</body>
</html>
