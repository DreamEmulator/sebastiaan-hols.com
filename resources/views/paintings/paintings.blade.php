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
                <h3>Art collection</h3>
                <h5>Dive into the divine</h5>
                <h6 class="text-muted">A collection of public domain artworks in hi-res with a magnifying glass</h6>
            </div>
        </div>
        <div class="card my-4 intro hide-text hidden" onclick="this.classList.remove('hidden')">
            <div class="card-body">
                <h4 class="card-title">Intro</h4>
                <p class="card-text">Here we have a collection of public domain art works that I find particularly
                    beautiful. Aside from simply wanting to share them with you, I also greatly enjoyed coding the
                    magnifying function. This JS trick is an example you find in the W3 basics, but there was still
                    considerable work to be done to fit their basic JS example into the modularity of Vue and the
                    responsiveness of Bootstrap.</p>
                <p>
                    I really enjoy opening this page up on my phone when I'm stuck in traffic and pouring over the
                    immaculate details of these pieces. It's truly astonishing to see how fine and meticulous these
                    paintings are built up and to realize that (much like code) every artwork is the end result of
                    endless iterations and updates, tweaks and alterations. I find these things truly inspiring and I
                    hope you do too.
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
                        <label for="subtitle">Artist</label>
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

        @guest
        <vue-loader></vue-loader>
        @endguest


    @auth
        @foreach($paintings as $painting)
            <div class="row featurette mt-4">
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
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{$painting->title}}">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Artist</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                   value="{{$painting->subtitle}}">
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
            </div>
                @endforeach
    </div>
            @endauth
@endsection

@section('non-vue')

@endsection
<script>
    import VueLoader from "../../assets/js/components/VueLoader";

    export default {
        components: {VueLoader}
    }
</script>