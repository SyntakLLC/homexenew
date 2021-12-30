<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Homexe') }}</title>
        
        <link rel="apple-touch-icon" sizes="180x180" :href="asset('apple-touch-icon.png?v=1')">
        <link rel="icon" type="image/png" sizes="32x32" :href="asset('favicon-32x32.png?v=1')">
        <link rel="icon" type="image/png" sizes="16x16" :href="asset('favicon-16x16.png?v=1')">
        <link rel="manifest" :href="asset('site.webmanifest?v=1')">
        <link rel="mask-icon" :href="asset('safari-pinned-tab.svg?v=1')" color="#1470c3">
        <link rel="shortcut icon" :href="asset('favicon.ico?v=1')">
        <meta name="apple-mobile-web-app-title" content="Homexe">
        <meta name="application-name" content="Homexe">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
</html>
