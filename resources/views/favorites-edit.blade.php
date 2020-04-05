<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases</title>

        @include('common-sections/head')
        
    </head>
    <body id="favorites-page" class="wrap">

        @include('common-sections/header')
        
        <section id="edit-favorite">
            <h2>Edit the music</h2>
            <form action="{{route('favorites-update')}}" method="get">
                <!-- csrf pour protéger des attaques -->
                <input type="hidden" name="track_id" value="{{$track_id}}">
                <input type="text" name="artists" value="{{$artist}}">
                <input type="text" name="track_name" value="{{$track_name}}">
                <button>Add</button>
            </form>
        </section>

        @include('common-sections/footer')
 
    </body>
</html>