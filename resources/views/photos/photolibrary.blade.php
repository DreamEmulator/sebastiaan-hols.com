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
                <h1>Photography</h1>

                {{--Skill.vue + submit form : Add the skills model to the route--}}
                <skills @auth:prod="true" @endauth :skill_name="'photography'"
                        :saved_skills="{{$skills->json}}"></skills>
                <form class="card-text" action="{{url('skills')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" style="display: none" class="form-control" id="skills_json"
                               name="skills_json">
                    </div>
                    <button id="submit_skills" style="display: none" type="submit" class="btn btn-primary"></button>
                </form>
                {{-- end --}}

                @auth
                    <div class="col-lg-12 card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Upload a new photo</h5>
                            <form class="card-text" action="{{url('photos')}}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Name of photo" maxlength="240">
                                </div>
                                <div class="form-group">
                                    <label for="text">Description</label>
                                    <input type="text" class="form-control" id="text" name="text"
                                           placeholder="Short description" maxlength="240">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <photo-library :photos="{{$photos}}"></photo-library>
            </div>
        </div>
    </div>

@endsection