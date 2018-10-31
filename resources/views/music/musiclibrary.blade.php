@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row justify-content-center mt-3">
                    <div class="col-lg-12 text-center">
                        <h3>Music</h3>
                        <h5>Stuff that sounds good</h5>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="card-title">Music</h4>
                        <p class="card-text">Here you can find a DJ mix set I made and a bunch of my favorite albums. I used to spend I considerable amount of time Dj'ing, but that has been superseded for an interest in coding. What I do still do and which always still amazes me, is organising the sound setup. This can be for a symposium or a club night (if you need speakers in Rotterdam send me a mail), either way the tangle of cables and connections is something I know my way around. Free tip: if you are talking to a large audience with a remote mic and it keeps searching. Turn your volume way down and tell the sound guy to turn his way up.</p>
                        <p>Below you will also find recommendations of albums I particularly enjoy along with some feeble attempts at being a reviewer for Pitchfork. These albums are from all sorts of artists and genre's, but each really has it's merit. The links below will not only get you straight to Tidal and Spotify, but also Muziekweb. This is a truly great resource for music, collected and maintained by a lot of dedicated experts (and my ex-colleagues) in Rotterdam. Their collection has been built up and meticulously maintained since 1963 and there is a big chance they will have what you are looking for if you can't find it anywhere else...</p>
                    </div>
                </div>

                {{--Skill.vue + submit form : Add the skills model to the route--}}
                <skills @auth:prod="true"@endauth :skill_name="'music'" :saved_skills="{{$skills->json}}"></skills>
                <form class="card-text" action="{{url('skills')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" style="display: none" class="form-control" id="skills_json" name="skills_json">
                    </div>
                    <button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>
                </form>
                {{-- end --}}

                <h3>Rezi</h3>
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