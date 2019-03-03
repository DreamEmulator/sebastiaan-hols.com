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
                <h5>Exciting examples and interesting insights</h5>
            </div>

            <div class="col-lg-8">
                <div class="card rounded-card my-2 intro hide-text hidden"
                     onclick="this.classList.toggle('hidden')">
                    <div class="card-body">
                        <h4 class="card-title">Intro</h4>
                        <p class="card-text">This website is my digital portfolio and at the same time an example of my
                            skills as a developer. It has been built in Laravel specifically to be able to define API's
                            for passing JSON to Vue JS. This combined with the proper authentication techniques deployed
                            by
                            Laravel makes it easy for me to change and update the pages through a CMS structure that can
                            work on a single page depending on your authentication status. The skills below for instance
                            can be clicked and opened to reveal extra info to a user, but
                            after being logged in the can accommodate an interactive preview layer that allows you to
                            drag and update the content.</p>
                        <p>As I have become more adept at deploying MVC setups in various languages, I have greatly come
                            to appreciate the modularity and cleanliness of the code it yields. At first it may seem
                            daunting to code a CMS like the one I built for this page, but as you delve deeper and
                            deeper and develop more code you really start to realize the brilliance and clairvoyance of
                            the people that make these frameworks. From Ruby on Rails to Spring to Laravel to Django,
                            simply browsing their file and folder structure on GitHub can give you great insights into
                            the solutions that experts have solved for us.</p>
                        <p>Besides from this site itself you can also click below to see a few examples of projects I
                            have developed or contributed to, some of them are not accessible to the public so a
                            screencapture has had to suffice. Also above there is a link to GitHub to see a few things I
                            am
                            currently working on, along with the code for the application you are in right now...</p>
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

                    <div class="card mb-4 rounded-card box-shadow d-inline-block w-100">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/hJA5E5bcpmc?rel=0&amp;controls=1&amp;showinfo=0"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Xerte Tracking</h4>
                            <p class="card-text">A tracking plugin I built for an open source education platform. This
                                project got me to get properly to grips woth GET, POST and Ajax. Also introduced me too
                                the great chart.js library.</p>
                        </div>
                    </div>
                    <a href="{{route('keepy-uppy')}}" target="_blank">
                        <div class="card rounded-card mb-4 box-shadow d-inline-block w-100">
                            <img class="card-img-top"
                                 src="{{asset('/img/frontend/coding/keepy_uppy.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Keepy Uppy</h4>
                                <p class="card-text">A small interactive game I came up with to illustrate the
                                    possibility
                                    of combining the VueJS framework with the PopMotion.io animation library.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Play ball
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
                    @auth
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
                    @endauth
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
                </div>
            </div>
        </div>
    </div>
@endsection