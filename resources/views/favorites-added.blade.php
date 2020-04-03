<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,600,700,800,900&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.png') }}" />
    </head>
    <body id="favorites-added-page" class="wrap">
        
        @include('common-sections/header')

        <section>
            <h2>Your favorite music has been added</h2>
            <a href="/favorites"><p>Go back to favorites</p></a>
        </section>
        
        @include('common-sections/footer')
 
    </body>
</html>

