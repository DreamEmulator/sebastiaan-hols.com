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
                    <div class="col-md-3 mb-4">
                        <h3 class="featurette-heading">{{$painting->title}}</h3>
                        <span class="text-muted">{{$painting->subtitle}}</span>
                        {{--<p class="lead">{{$painting->story}}</p>--}}
                    </div>
                    <div class="col-md-9">
                        <vue-magnifier src="{{$painting->location}}"
                                       src-large="{{$painting->location}}"></vue-magnifier>
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
                            <label for="title">Title</label>
                            {{--<input type="text" class="form-control" id="title" name="title" value="{{$painting->title}}">--}}
                        </div>
                        <div class="form-group">
                            <label for="painting_pic">Replace image</label>
                            <img class="featurette-image img-fluid m-2" style="max-height: 50px"
                                 src="{{$painting->location}}" alt="{{$painting->subtitle}}">
                            <input class="form-control" type="file" name="painting_pic">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                   value="{{$painting->subtitle}}">
                        </div>
                        <div class="form-group">
                            <label for="story">painting</label>
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
