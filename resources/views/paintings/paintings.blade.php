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
                <h3>Picture perfect</h3>
                <h5>Dive into the divine</h5>
                <h6 class="text-muted">A collection of public domain artworks in hi-res with a magnifying glass</h6>
            </div>
        </div>
        <div class="card my-4 intro-text hidden" onclick="this.classList.remove('hidden')">
            <div class="card-body">
                <h4 class="card-title">Art collection</h4>
                <p class="card-text">Here we have a collection of public domain art works that I find particularly beautiful. Aside from simply wanting to share them with you, I also greatly enjoyed coding the magnifying function. This JS trick is an example you find in the W3 basics, but there was still considerable work to be done to fit their basic JS example into the modularity of Vue and the responsiveness of Bootstrap.</p><p>
                    I really enjoy opening this page up on my phone when I'm stuck in traffic and pouring over the immaculate details of these pieces. It's truly astonishing to see how fine and meticulous these paintings are built up and to realize that (much like code) every artwork is the end result of endless iterations and updates, tweaks and alterations. I find these things truly inspiring and I hope you do too.
                </p>
            </div>
        </div>
        @auth
            <div class="col-md-12 mb-4 bg-{{$dream_theme}} p-4">
                <h2>New painting...</h2>
                <form class="card-text" action="{{url('paintings')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Think of a cool title...">
                    </div>
                    <div class="form-group">
                        <input type="file" name="painting_pic">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                               placeholder="Gotta have a sub...">
                    </div>
                    <div class="form-group">
                        <label for="story">painting</label>
                        <textarea class="form-control" id="story" name="story" placeholder="Spill the beans!"
                                  maxlength="2500"></textarea>
                    </div>
                    <button id="submit_painting" type="submit" class="btn btn-primary">Paint</button>
                </form>
            </div>
        @endauth

        @foreach($paintings as $painting)
            <hr class="w-100">
            <div class="row featurette mt-4">
                @guest
                        <div class="col-lg-12">
                            <h3 class="featurette-heading">{{$painting->title}}</h3>
                            <h4 class="text-muted">{{$painting->subtitle}}</h4>
                            {{--<p class="lead">{{$painting->story}}</p>--}}
                        </div>
                        <div class="col-lg-12">
                            <vue-magnifier src="{{$painting->location}}" src-large="{{$painting->location}}" index="{{$loop->iteration}}"></vue-magnifier>
                        </div>
                @endguest
            </div>

            @auth
                <div class="col-md-12 mb-4 bg-{{$dream_theme}} p-4">
                    <h2>Edit painting...</h2>
                    <form class="card-text" action="{{action('PaintingsController@update', $painting['id'])}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="painting_pic">Replace image</label>
                            <img class="featurette-image img-fluid m-2" style="max-height: 50px"
                                 src="{{$painting->location}}" alt="{{$painting->subtitle}}">
                            <input class="form-control" type="file" name="painting_pic">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$painting->title}}">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Artist</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                   value="{{$painting->subtitle}}">
                        </div>
                        <div class="form-group">
                            <label for="story">Story</label>
                            <textarea class="form-control" id="story" name="story"
                                      maxlength="2500">{{$painting->story}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <form id="delete_painting_{{$painting['id']}}"
                          action="{{action('PaintingsController@destroy', $painting['id'])}}"
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

@section('non-vue')

@endsection
