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

                    @foreach($photos as $photo)
                        <div class="col-lg-6 mt-2 mb-2">
                            <div class="card rounded-card">
                                <img class="card-img-top" src="{{$photo->location}}">
                                <div class="card-body">
                                    <form id="update_photo_{{$photo['id']}}" action="{{action('PhotoController@update', $photo['id'])}}"  method="post">
                                        @csrf
                                        @method('PATCH')
                                        {{--<input name="_method" type="hidden" value="PATCH">--}}
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{$photo->title}}" maxlength="240">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Description:</label>
                                            <input type="text" name="text" class="form-control"
                                                   value="{{$photo->text}}" maxlength="240">
                                        </div>
                                        <button type="submit" style="display: none"></button>
                                    </form>
                                    <form id="delete_photo_{{$photo['id']}}"
                                          action="{{action('PhotoController@destroy', $photo['id'])}}"
                                          method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" style="display: none"></button>
                                    </form>
                                    <button class="btn btn-primary"
                                            onclick="event.preventDefault();document.getElementById('update_photo_{{$photo['id']}}').submit();">
                                        Update
                                    </button>
                                    <button class="btn btn-danger"
                                            onclick="event.preventDefault();document.getElementById('delete_photo_{{$photo['id']}}').submit();">
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