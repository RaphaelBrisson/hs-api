<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases</title>

        @include('common-sections/head')
        
    </head>
    <body id="favorites-edited-page" class="wrap">
        
        @include('common-sections/header')

        <section>
            <h2>The music has been edited</h2>
            <a href="/favorites"><p>Go back to favorites</p></a>
        </section>
        
        @include('common-sections/footer')
 
    </body>
</html>

