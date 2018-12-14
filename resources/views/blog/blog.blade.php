@extends('layouts.app')
@section('content')
    @php
        if (session('dream_theme') !== null){$dream_theme = session('dream_theme');} else {$dream_theme = 'light';}
    @endphp
    @if (\Session::has('fail'))
        <div class="alert alert-danger">
            <p>{{ \Session::get('fail') }}</p>
        </div><br/>
    @endif
    <div class="container marketing">

        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <h3>Dev Blog</h3>
                <h5>A blog about stuff I find interesting as a developer</h5>
            </div>
        </div>

        <div class="card my-4 intro-text hidden" onclick="this.classList.remove('hidden')">
            <div class="card-body">
                <h4 class="card-title">Intro</h4>
                <p class="card-text">This blog is meant as kind of running insight into the things I learn and create as
                    a developer. This way I you can find out if my interests in coding are aligned with yours and if it
                    might interesting to collaborate or useful te ask for input. My focus is primarily on frontend
                    and reactive programming frameworks (Vue, React, Angular), but I am also focusing on creating a
                    strong foundation in more server side object oriented programming through a Java & App developer
                    Certification from the Open University. I also have a lot of experience in UX design and customizing
                    interfaces of existing projects or frameworks in order to enhance the user's efficiency and
                    experience. These questions are often strongly geared towards JS and SCSS, but I find good use of
                    basic HTML is often overlooked.</p>
                <p>I hope you find an interesting read 🤓</p>
            </div>
        </div>

        @auth
            <div class="col-md-12 mb-4 bg-{{$dream_theme}} p-4">
                <h2>New blog...</h2>
                <form class="card-text" action="{{url('blog')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Think of a cool title...">
                    </div>
                    <div class="form-group">
                        <input type="file" name="blog_pic">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                               placeholder="Gotta have a sub...">
                    </div>
                    <div class="form-group">
                        <label for="story">blog</label>
                        <textarea class="form-control" id="story" name="story" placeholder="Spill the beans!"
                                  maxlength="2500"></textarea>
                    </div>
                    <button id="submit_blog" type="submit" class="btn btn-primary">blog</button>
                </form>
            </div>
        @endauth

        @foreach($blogs as $blog)
            <hr class="w-100">
            <div class="row featurette mt-4">
                @guest
                    @if($loop->iteration % 2 == 0)
                        <div class="col-md-7">
                            <h3 class="featurette-heading">{{$blog->title}}</h3>
                            <span class="text-muted">{{$blog->subtitle}}</span>
                            <p class="lead body hide-text hidden" onclick="this.classList.remove('hidden')">{{$blog->story}}</p>
                            <p class="text-muted">{{$blog->created_at}}</p>
                        </div>
                        <div class="col-md-5">
                            <img class="featurette-image img-fluid mx-auto"
                                 src="{{$blog->location}}" alt="{{$blog->subtitle}}">
                        </div>
                    @else
                        <hr class="featurette-divider">
                        <div class="col-md-5">
                            <img class="featurette-image img-fluid mx-auto"
                                 src="{{$blog->location}}" alt="{{$blog->subtitle}}">
                        </div>
                        <div class="col-md-7">
                            <h3 class="featurette-heading">{{$blog->title}}</h3>
                            <span class="text-muted">{{$blog->subtitle}}</span>
                            <p class="lead body hide-text hidden" onclick="this.classList.remove('hidden')">{{$blog->story}}</p>
                            <p class="text-muted">{{$blog->created_at}}</p>
                        </div>
                    @endif
                @endguest
            </div>

            @auth
                <div class="col-md-12 mb-4 bg-{{$dream_theme}} p-4">
                    <h2>Edit blog...</h2>
                    <form class="card-text" action="{{action('BlogController@update', $blog['id'])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}">
                        </div>
                        <div class="form-group">
                            <label for="blog_pic">Replace image</label>
                            <img class="featurette-image img-fluid m-2" style="max-height: 50px"
                                 src="{{$blog->location}}" alt="{{$blog->subtitle}}">
                            <input class="form-control" type="file" name="blog_pic">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                   value="{{$blog->subtitle}}">
                        </div>
                        <div class="form-group">
                            <label for="story">Blog</label>
                            <textarea class="form-control" id="story" name="story"
                                      maxlength="2500">{{$blog->story}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <form id="delete_blog_{{$blog['id']}}"
                          action="{{action('BlogController@destroy', $blog['id'])}}"
                          method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger mt-2" type="submit">Delete</button>
                    </form>
                </div>
            @endauth

        @endforeach
    </div>


@endsection