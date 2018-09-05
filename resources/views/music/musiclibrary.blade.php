@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Live mixes</h3>
                <p class="w-30">This mix combines my photography with the tracks I felt connected well to the rough and rugged feeling of urban excitement you find everywhere in Rotterdam.</p>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/tv56iyECa-Y?rel=0&amp;showinfo=0"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <h3 class="w-100 mt-3">Favorite albums</h3>
                <div class="card-columns">
                    @foreach($musics as $music)
                        <div class="card" style="max-width: 22.5rem;">
                            <img class="card-img-top"
                                 src="{{$music->img_location}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$music->title}}</h5>
                                <p class="card-text">{{$music->text}}</p>
                            </div>
                            <div class="card-footer">
                                @if($music->muziekweb)
                                    <a href="{{$music->muziekweb}}" target="_blank"><i
                                                class="fas fa-bullseye text-warning fa-2x"></i></a>
                                @endif
                                @if($music->spotify)
                                    <a href="{{$music->spotify}}" target="_blank"><i
                                                class="fab fa-spotify text-success fa-2x"></i></a>
                                @endif
                                    @if($music->tidal)
                                    <a href="{{$music->tidal}}" target="_blank"><img class="tidal-icon" src="img/frontend/music/favicon.ico"></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection