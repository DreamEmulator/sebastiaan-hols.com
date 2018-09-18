@extends('layouts.app')
@section('content')
@php
    if (session('dream_theme') !== null){$dream_theme = session('dream_theme');} else {$dream_theme = 'light';}
@endphp
    <div class="container marketing">

        <div class="row justify-content-center">
            <div class="col-lg-4 text-center">
                <img class="rounded-circle mb-4" src="{{asset('/img/frontend/about/prof3.jpg')}}"
                     alt="Generic placeholder image" width="140" height="140">
                <h3>Sebastiaan Hols</h3>
                <h5>Designer + Developer</h5>
            </div>
        </div>

        {{--Skill.vue + submit form : Add the skills model to the route--}}
        <skills @auth :prod="true" @endauth :skill_name="'personal'" :saved_skills="{{$skills->json}}"></skills>
        <form class="card-text" action="{{url('skills')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" style="display: none" class="form-control" id="skills_json" name="skills_json">
            </div>
            <button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>
        </form>
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
            <div class="row featurette">
                @if($loop->iteration % 2 == 0)
                    <div class="col-md-7">
                        <h3 class="featurette-heading">{{$post->title}}</h3>
                        <span class="text-muted">{{$post->subtitle}}</span>
                        <p class="lead">{{$post->story}}</p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto"
                             src="{{$post->location}}" alt="{{$post->subtitle}}">
                    </div>
                @else
                    <hr class="featurette-divider">
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto"
                             src="{{$post->location}}" alt="{{$post->subtitle}}">
                    </div>
                    <div class="col-md-7">
                        <h3 class="featurette-heading">{{$post->title}}</h3>
                        <span class="text-muted">{{$post->subtitle}}</span>
                        <p class="lead">{{$post->story}}</p>
                    </div>
                @endif

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