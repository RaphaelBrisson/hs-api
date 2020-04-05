<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases | {{$artist_name}}</title>

        @include('common-sections/head')
        
    </head>
    <body id="artist-page" class="wrap">
        
        @include('common-sections/header')

        <section id="artist-data">
            <h2 class="artist-name">{{$artist_name}}</h2>
            <img src="{{$artist_picture}}" alt="picture of the artist">
        </section>

        <section id="artist-releases">
            <h2>His/her releases</h2>
            <div class="artist-releases-container">
                <div class="artist-releases-titles">
                    <div class="dn-phone">
                        <h3>Artwork</h3>
                    </div>
                    <div>
                        <h3>Artist(s)</h3>
                    </div>
                    <div>
                        <h3>Track name</h3>
                    </div>
                </div>
                @foreach($tracklist_tracks as $key => $tracklist_track)
                    <div class="artist-releases-track">
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
                    </div>
                @endforeach
            </div>
        </section>

        @include('common-sections/footer')
 
    </body>
</html>
