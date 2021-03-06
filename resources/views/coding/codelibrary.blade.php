@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <a href="https://github.com/DreamEmulator" target="_blank">
                    <svg class="bg-light rounded-circle git-logo" height="40" width="40"
                         class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                    </svg>
                </a>

                <a href="https://teamtreehouse.com/sebastiaanhols" target="_blank">
                    <img class="treehouse-logo"
                         src="{{asset('/img/frontend/about/education_logos/teamTreehouse.png')}}">
                </a>
            </div>
            <div class="col-lg-12 text-center justify-content-center mt-3">
                <h3>Coding</h3>
                <h5>Examples and insights</h5>
            </div>

            <div class="col-lg-8">
                <div class="card rounded-card my-2 intro hide-text hidden"
                     onclick="this.classList.toggle('hidden')">
                    <div class="card-body">
                        <h4 class="card-title">Work</h4>
                        <p class="card-text">
                        <p>Most of the time I am developing apps in React-Native, but I also enjoy developing iOS apps with Swift, because it's easier to use lower level frameworks like AVAudioEngine. I like to make software that feels natural. I'm lucky to work professionally with really great designers and I always aim to bring their clarity into the code. Up above there is a link to GitHub if you want to see what I am up to.</p>
                    </div>
                </div>
            </div>
            {{--Skill.vue + submit form : Add the skills model to the route--}}
            <div class="col-lg-4">
                <skills @auth:prod="true" @endauth :skill_name="'coding'"
                        :saved_skills="{{$skills->json}}"></skills>
            </div>
            @auth
                <form class="card-text" action="{{url('skills')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" style="display: none" class="form-control" id="skills_json"
                               name="skills_json">
                    </div>
                    <button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>
                </form>
            @endauth
            {{-- end --}}

            <div class="col-lg-12 mt-2">
                <div class="card-columns">

                    <a href="https://www.emerce.nl/wire/in10-wint-gold-lovie-award-publieksprijs-digitale-museumervaring-ed-der-elsken"
                       target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/lust_for_life.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Lust for Life</h4>
                                <p class="card-text">An award winning app with Image Recognition for the Fotomuseum in
                                    Rotterdam that
                                    combined react-native and image recognition to quickly recognize images and unlock
                                    the stories behind the photographs.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Bezing het leven
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://dream-emulator.net" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/dream_emulator.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Dream-Emulator</h4>
                                <p class="card-text">A side project in which I'm trying to combine music and photography
                                    in a new way.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">An experiment in
                                            Interaction
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://apps.apple.com/us/app/tegoed-checker/id1495624582" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/tegoed_checker.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Tegoed Checker</h4>
                                <p class="card-text">An app for the Municipality of Rotterdam. The Tegoed Checker
                                    (Balance checker) allows people to quickly scan their Rotterdam card an check how
                                    much balance is still left on it. (Android & iOS)
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Bekijk snel en
                                            simpel uw tegoed
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="http://dream-house-3d.netlify.app" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/dream_house_3d.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Dream-House 3D</h4>
                                <p class="card-text">This is a pet project to learn 3D modeling by combining ThreeJS,
                                    React and Blender</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Blender X ThreeJS
                                            X React
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://play.google.com/store/apps/details?id=com.dordtpas&hl=en_GB" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/dordtpas_app.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Dordtpas App</h4>
                                <p class="card-text">An fun new way to discover Dordrecht. The Dordtpas is the city card
                                    of Dordrecht and the funnest way to find, favorite and discover (Android & iOS)
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Ontdek Dordt!
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="card mb-4 rounded-card box-shadow d-inline-block w-100">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/hJA5E5bcpmc?rel=0&amp;controls=1&amp;showinfo=0"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Xerte Tracking</h4>
                            <p class="card-text">A tracking plugin I built for an open source education platform. This
                                project got me to get properly to grips with GET, POST and Ajax. Also introduced me too
                                the great chart.js library.</p>
                        </div>
                    </div>

                    <a href="https://www.kinderdijk.com/activities/kinderdijk-app/" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/kinderdijk.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Kinderdijk App</h4>
                                <p class="card-text">An audio tour app for a UNESCO World Heritage site that receives
                                    thousands of visitors per year. I helped build a location based video experience
                                    that shows you how the site looks in different times.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Deep dive into
                                            Kinderdijk
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://muziekweb.nl/Intros" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/intros.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Muziekweb Intro's</h4>
                                <p class="card-text">Discovering new music whilst learning about the rich history the
                                    collection of Muziekweb houses is the key of the Muziekweb Intro's.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Discover New
                                            Music
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/clock">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/nomos_metro.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Vue Clock</h4>
                                <p class="card-text">An interesting exercise in making radial patterns in
                                    Illustrator
                                    and
                                    juggling time with the Date object in JS.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Got the time?
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://filmbieb.nl" target="_blank">
                        <div class="card mb-4 rounded-card box-shadow d-inline-block w-100">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/c93pKlsLtFo?rel=0&amp;showinfo=1"
                                        frameborder="0"
                                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Filmbieb Touchbrowser</h4>
                                <p class="card-text">The Filmbieb touchbrowser is a touch focussed interface I built
                                    with
                                    the team at Muziekweb to allow visitors in the library to easily discorver
                                    video's.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Discover Movies
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{route('keepy-uppy')}}" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/keepy_uppy.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Keepy Uppy</h4>
                                <p class="card-text">A small interactive game I came up with to illustrate the
                                    possibility of combining the VueJS framework with the PopMotion.io animation
                                    library.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Play ball
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://www.gelrepas.nl" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/gelrepas_app.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Gelrepas App</h4>
                                <p class="card-text">Quick and easy access to your Gelrepas. The app is written in
                                    TypeScript and React Native for Android & iOS
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Op pad met je pas
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
