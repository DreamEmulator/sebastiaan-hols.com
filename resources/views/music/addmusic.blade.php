@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 card mt-4">
            <div class="card-body">
                <h5 class="card-title">Add new music</h5>
                <form class="card-text" action="{{url('music')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name of music" maxlength="240">
                    </div>
                    <div class="form-group">
                        <label for="text">Review</label>
                        <textarea class="form-control" id="text" name="text" placeholder="Short review" maxlength="240"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="spotify">Spotify</label>
                        <input type="text" class="form-control" id="spotify" name="spotify" placeholder="Spotify link" maxlength="240">
                    </div>
                    <div class="form-group">
                        <label for="tidal">Tidal</label>
                        <input type="text" class="form-control" id="tidal" name="tidal" placeholder="Tidal link" maxlength="240">
                    </div>
                    <div class="form-group">
                        <label for="muziekweb">Muziekweb</label>
                        <input type="text" class="form-control" id="muziekweb" name="muziekweb" placeholder="Muziekweb link" maxlength="240">
                    </div>
                    <div class="form-group">
                        <label for="img_location">Image Url</label>
                        <input type="text" class="form-control" id="img_location" name="img_location" placeholder="URL for image" maxlength="240">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection