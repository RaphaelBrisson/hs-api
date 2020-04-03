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
    <body id="favorites-page" class="wrap">

        @include('common-sections/header')
        
        <section id="add-new-favorite">
            <h2>Add a music to your favorites</h2>
            <form action="{{route('favorites-insert')}}" method="post">
                <!-- csrf pour protéger des attaques -->
                @csrf
                <input type="text" name="artists" placeholder="Artist(s)">
                <input type="text" name="track_name" placeholder="Track Name">
                <button>Add</button>
            </form>
        </section>
        <section id="list-favorites">
            <h2>All your favorites music</h2>
            <div class="favorites-container">
                <div class="favorites-titles">
                    <div>
                        <h3>Artist(s)</h3>
                    </div>
                    <div>
                        <h3>Track name</h3>
                    </div>
                </div>
                @foreach($favorites as $favorite)
                    <div class="favorite-track">
                        <div>
                            <p>{{$favorite->artists}}</p>
                        </div>
                        <div>
                            <p>{{$favorite->track_name}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        @include('common-sections/footer')
 
    </body>
</html>


