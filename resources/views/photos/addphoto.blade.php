@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 card mt-4">
            <div class="card-body">
                <h5 class="card-title">Upload a new photo</h5>
                <form class="card-text" action="{{url('photos')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Name of photo">
                    </div>
                    <div class="form-group">
                        <label for="text">Description</label>
                        <input type="text" class="form-control" id="text" name="text" placeholder="Short description">
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection