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
                <p class="lead text-muted">Click to open</p>
                <photo-library :photos="{{$photos}}"></photo-library>
            </div>
        </div>
    </div>

@endsection