<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hardstyle-Releases | Favorites</title>

        @include('common-sections/head')
        
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
                        <form action="{{route('favorites-delete')}}" method="get">
                            @csrf
                            <input type="hidden" name="track_id" value="{{$favorite->id}}">
                            <button>Delete</button>
                        </form>
                        <form action="{{route('favorites-edit')}}" method="get">
                            
                            <input type="hidden" name="track_id" value="{{$favorite->id}}">
                            <button>Edit</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>

        @include('common-sections/footer')
 
    </body>
</html>


