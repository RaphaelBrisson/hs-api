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
    <body id="home-page" class="wrap">
        
        @include('common-sections/header')

        <section id="baseline">
            <h1>Discover the world of the harder styles!</h1>
        </section>
        <section id="top-40">
            <h2>{{$playlist_title}}</h2>
            <p class="top-40-description">A playlist of the 40 most popular hardstyle tracks which is updated every Friday.</p>
            <div class="top-40-container">
                <div class="top-40-titles">
                    <div>
                        <h3>Pos.</h3>
                    </div>
                    <div class="dn-phone">
                        <h3>Artwork</h3>
                    </div>                   
                    <div>
                        <h3>Artist(s)</h3>
                    </div>
                    <div>
                        <h3>Track name</h3>
                    </div>
                    <div class="dn-tablet">
                        <h3>Release date</h3>
                    </div>
                </div>
                @foreach($playlist_tracks as $key => $playlist_track)
                    <div class="top-40-track">
                        <div>
                            <p>{{$loop->iteration}}</p>
                        </div>
                        <div class="dn-phone">
                            <img src="{{$artwork[$key]}}" alt="">
                        </div>
                        <div>
                            @foreach($artists_table[$key] as $key2 => $contributors)
                                <p class="artist"><a href="/artist/{{$artists_id_table[$key][$key2]}}">
                                    {{$artists_table[$key][$key2]}}
                                </a></p>
                                <p> - </p>
                            @endforeach
                        </div>
                        <div>
                            <p>{{$track_title[$key]}}</p>
                        </div>
                        <div class="dn-tablet">
                            <p>{{$release_date[$key]}}</p>
                        </div>
                        <form action="{{route('favorites-insert')}}" method="post">
                            <!-- @csrf pour protéger des attaques -->
                            @csrf
                            <input type="hidden" name="artists" value="{{$azerty[$key]}}">
                            <input type="hidden" name="track_name" value="{{$track_title[$key]}}">
                            <button>Add to favorites</button>
                        </form>
                    </div>
                @endforeach

            </div>
        </section>

        @include('common-sections/footer')

        <script src="/js/app.js"></script>
        
    </body>
</html>
