@extends('layouts.app')

@section('content')
    @if (\Session::has('fail'))
        <div class="alert alert-danger">
            <p>{{ \Session::get('fail') }}</p>
        </div><br/>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Photo library</h1>
                <div class="row">
                    @foreach($musics as $music)
                        <div class="col-lg-6 mt-2 mb-2">
                            <div class="card">
                                <img class="card-img-top" src="{{$music->img_location}}">
                                <div class="card-body">
                                    <form id="update_music_{{$music['id']}}" action="{{action('MusicController@update', $music['id'])}}"  method="post">
                                        @csrf
                                        @method('PATCH')
                                        {{--<input name="_method" type="hidden" value="PATCH">--}}
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{$music->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Text:</label>
                                            <textarea type="text" name="text" class="form-control"
                                                      >{{$music->text}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="img_location">Image url:</label>
                                            <input type="text" name="img_location" class="form-control"
                                                   value="{{$music->img_location}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="spotify">Spotify:</label>
                                            <input type="text" name="spotify" class="form-control"
                                                   value="{{$music->spotify}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tidal">Tidal:</label>
                                            <input type="text" name="tidal" class="form-control"
                                                   value="{{$music->tidal}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="muziekweb">Muziekweb:</label>
                                            <input type="text" name="muziekweb" class="form-control"
                                                   value="{{$music->muziekweb}}">
                                        </div>
                                        <button type="submit" style="display: none"></button>
                                    </form>
                                    <form id="delete_music_{{$music['id']}}"
                                          action="{{action('MusicController@destroy', $music['id'])}}"
                                          method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" style="display: none"></button>
                                    </form>
                                    <button class="btn btn-primary"
                                            onclick="event.preventDefault();document.getElementById('update_music_{{$music['id']}}').submit();">
                                        Update
                                    </button>
                                    <button class="btn btn-danger"
                                            onclick="event.preventDefault();document.getElementById('delete_music_{{$music['id']}}').submit();">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection