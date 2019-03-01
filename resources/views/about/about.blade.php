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
                <h5>Designer + Developer</h5>
            </div>
        </div>

        <div class="row">
            <div class="card-columns col-lg-12 d-flex align-items-stretch" style="column-count: 4">
                <div class="card d-inline-block mt-4 mx-2 pt-2 w-100 text-center" style="border-radius: 15px">
                    <img src="{{asset('/img/frontend/about/education_logos/ou.png')}}"
                         class="card-img-top rounded-circle" style="max-height: 150px; max-width: 150px">
                    <div class="card-body"><h4 class="card-title">Certified Java & App Developer</h4>
                        <p class="card-text">Open University</p>
                    </div>
                </div>
                <div class="card d-inline-block mt-4 mx-2 pt-2 w-100 text-center" style="border-radius: 15px">
                    <img src="{{asset('/img/frontend/about/education_logos/eur.jpg')}}"
                         class="card-img-top" style="max-height: 150px; max-width: 150px">
                    <div class="card-body"><h4 class="card-title">Master of Arts</h4>
                        <p class="card-text">Erasmus University</p>
                    </div>
                </div>
                <div class="card d-inline-block mt-4 mx-2 pt-2 w-100 text-center" style="border-radius: 15px">
                    <img src="{{asset('/img/frontend/about/education_logos/glr.jpg')}}"
                         class="card-img-top" style="max-height: 150px; max-width: 150px">
                    <div class="card-body"><h4 class="card-title">Graphic Design & Web Development</h4>
                        <p class="card-text">Grafisch Lyceum Rotterdam - Media College</p>
                    </div>
                </div>
                <div class="card d-inline-block mt-4 mx-2 pt-2 w-100 text-center" style="border-radius: 15px">
                    <img src="{{asset('/img/frontend/about/education_logos/uu.png')}}"
                         class="card-img-top rounded-circle" style="max-height: 150px; max-width: 150px">
                    <div class="card-body"><h4 class="card-title">Bachelor of Arts</h4>
                        <p class="card-text">University College Utrecht</p>
                    </div>
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


@endsection