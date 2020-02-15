@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Music</h3>
                <h5>Stuff that sounds good</h5>
            </div>

            <div class="col-lg-12">
                <div class="card rounded-card my-2 intro hide-text hidden" onclick="this.classList.toggle('hidden')">
                    <div class="card-body">
                        <h4 class="card-title">Intro</h4>
                        <p class="card-text">Here you can find a DJ mix set I made and a bunch of my favorite albums. I
                            used to spend I considerable amount of time Dj'ing, but that has been superseded for an
                            interest in coding. What I do still do and which always still amazes me, is organising the
                            sound setup.</p>
                        <p>Below you will also find recommendations of albums I particularly enjoy along with some
                            feeble attempts at being a reviewer for Pitchfork. These albums are from all sorts of
                            artists and genre's, but each really has it's merit. The links below will not only get you
                            straight to Tidal and Spotify, but also Muziekweb. Muziekweb is a great resource for music,
                            collected and maintained by a lot of dedicated experts (and my ex-colleagues) in Rotterdam.
                            Their collection has been built up and meticulously organised since 1963 and there is a big
                            chance they will have what you are looking for if you can't find it anywhere else...</p>
                    </div>
                </div>
            {{--</div>--}}
            {{--Skill.vue + submit form : Add the skills model to the route--}}
            {{--<div class="col-lg-4">--}}
                {{--<skills @auth:prod="true" @endauth :skill_name="'music'"--}}
                        {{--:saved_skills="{{$skills->json}}"></skills>--}}
            {{--</div>--}}
            {{--@auth--}}
                {{--<form class="card-text rounded-card" action="{{url('skills')}}" method="post"--}}
                      {{--enctype="multipart/form-data">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" style="display: none" class="form-control" id="skills_json"--}}
                               {{--name="skills_json">--}}
                    {{--</div>--}}
                    {{--<button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>--}}
                {{--</form>--}}
            {{--@endauth--}}
            {{-- end --}}

            {{--<div class="col-lg-12">--}}

                <h3>Rezi</h3>
                <p class="w-30">This mix combines my photography with the tracks I felt connected well to the rough and
                    rugged feeling you find everywhere in Rotterdam.</p>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/tv56iyECa-Y?rel=0&amp;showinfo=0"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <h3 class="w-100 mt-3">Favorite albums</h3>
                <div class="card-columns">
                    @foreach($musics as $music)
                        <div class="card rounded-card" style="max-width: 22.5rem;">
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
                                    <a href="{{$music->tidal}}" target="_blank"><img class="tidal-icon"
                                                                                     src="img/frontend/music/favicon.ico"></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection