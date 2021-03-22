@extends('layouts.app')
@section('content')
    @php
        if (session('dream_theme') !== null){$dream_theme = session('dream_theme');} else {$dream_theme = 'light';}
    @endphp
    <div class="container marketing">

        <div class="row justify-content-center">
            <div class="col-lg-4 text-center">
                <img class="rounded-circle mb-4" src="{{asset('/img/frontend/about/profile_pic.JPG')}}"
                     alt="Generic placeholder image" width="140" height="140">
                <h3>Sebastiaan Hols</h3>
                <h5>Developer + Photographer</h5>
                <a href="https://github.com/DreamEmulator" target="_blank">
                    <svg class="bg-light rounded-circle git-logo" height="40" width="40"
                         class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/in/sebastiaan-hols/"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <h4>Education</h4>
        </div>
        <div class="card-columns col-lg-12">
            <div class="card d-inline-block pt-4 w-100 text-center" style="border-radius: 15px;">
                <img src="{{asset('/img/frontend/about/education_logos/eur.jpg')}}"
                     class="card-img-top" style="max-height: 150px; max-width: 150px; border: 5px solid #fff">
                <div class="card-body"><h4 class="card-title">Master of Arts</h4>
                    <p class="card-text">Erasmus University</p>
                </div>
            </div>
            <div class="card d-inline-block pt-4 w-100 text-center" style="border-radius: 15px;">
                <img src="{{asset('/img/frontend/about/education_logos/uu.png')}}"
                     class="card-img-top rounded-circle" style="max-height: 150px; max-width: 150px;">
                <div class="card-body"><h4 class="card-title">Bachelor of Arts</h4>
                    <p class="card-text">University College Utrecht</p>
                </div>
            </div>
            <div class="card d-inline-block pt-4 w-100 text-center" style="border-radius: 15px">
                <img src="{{asset('/img/frontend/about/education_logos/ou.png')}}"
                     class="card-img-top rounded-circle"
                     style="max-height: 150px; max-width: 150px; border: 5px solid #fff">
                <div class="card-body"><h4 class="card-title">Java & App Developer Course</h4>
                    <p class="card-text">Open University</p>
                </div>
            </div>
            <div class="card d-inline-block pt-4 w-100 text-center" style="border-radius: 15px;">
                <img src="{{asset('/img/frontend/about/education_logos/glr.jpg')}}"
                     class="card-img-top" style="max-height: 150px; max-width: 150px; border: 5px solid #fff">
                <div class="card-body"><h4 class="card-title">Web & Graphic Design Course</h4>
                    <p class="card-text">Grafisch Lyceum Rotterdam - Media College</p>
                </div>
            </div>
        </div>

        {{--Skill.vue + submit form : Add the skills model to the route--}}
        {{--<skills @auth :prod="true" @endauth :skill_name="'personal'" :saved_skills="{{$skills->json}}"></skills>--}}
        {{--<form class="card-text" action="{{url('skills')}}" method="post" enctype="multipart/form-data">--}}
        {{--{{ csrf_field() }}--}}
        {{--<div class="form-group">--}}
        {{--<input type="text" style="display: none" class="form-control" id="skills_json" name="skills_json">--}}
        {{--</div>--}}
        {{--<button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>--}}
        {{--</form>--}}
        {{-- end --}}
        <hr class="w-100">
        <div class="col-lg-12">
            <h4>Experience</h4>
        </div>
        @auth
            <div class="col-md-12 mb-4 bg-{{$dream_theme}} p-4">
                <h2>New Post...</h2>
                <form class="card-text" action="{{url('posts')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Think of a cool title...">
                    </div>
                    <div class="form-group">
                        <input type="file" name="post_pic">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                               placeholder="Gotta have a sub...">
                    </div>
                    <div class="form-group">
                        <label for="story">Post</label>
                        <textarea class="form-control" id="story" name="story" placeholder="Spill the beans!"
                                  maxlength="2500"></textarea>
                    </div>
                    <button id="submit_post" type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        @endauth

        <div class="col-lg-12">
            @foreach($posts as $post)
                <div class="row featurette mt-3">
                    <hr class="featurette-divider">
                    <div class="col-md-5">
                        <img class="img-fluid float-right mb-4"
                             src="{{$post->location}}" alt="{{$post->subtitle}}"
                             style="border-radius: 15px; border: solid #fff 5px; max-height: 200px">
                    </div>
                    <div class="col-md-7 mt-3">
                        <h3 class="featurette-heading">{{$post->title}}</h3>
                        <span class="text-muted">{{$post->subtitle}}</span>
                        <p class="lead">{{$post->story}}</p>
                    </div>
                    @auth

                        <div class="col-md-12">
                            <form id="delete_post_{{$post['id']}}"
                                  action="{{action('PostController@destroy', $post['id'])}}"
                                  method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" style="display: none"></button>
                                <button class="btn btn-danger mt-2" type="submit">Delete</button>
                            </form>
                        </div>
                    @endauth

                </div>
            @endforeach
        </div>

    </div>


@endsection
