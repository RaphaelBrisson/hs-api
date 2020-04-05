<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases</title>

        @include('common-sections/head')
        
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
                    <div>
                        
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
                        <div>
                            <form action="{{route('favorites-insert')}}" method="post">
                                <!-- csrf pour protéger des attaques -->
                                @csrf
                                <input type="hidden" name="artists" value="{{$all_artists[$key]}}">
                                <input type="hidden" name="track_name" value="{{$track_title[$key]}}">
                                <button>Add to favorites</button>
                            </form>
                        </div>  
                    </div>
                @endforeach

            </div>
        </section>

        @include('common-sections/footer')
        
    </body>
</html>
