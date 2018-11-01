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
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <h3>Photography</h3>
                        <h5>A selection of my favorite photographs</h5>
                    </div>
                </div>

                <div class="card my-4 intro-text hidden" onclick="this.classList.remove('hidden')">
                    <div class="card-body">
                        <h4 class="card-title">Photography</h4>
                        <p class="card-text">This is a showcase of my photography. Most of the pictures here are
                            artistic or architectural in nature. I also do a lot of portrait work, but I have chosen
                            specifically not to feature that here.</p>
                        <p>For me photography is really a way to unwind and discover. It allows me to approach a city or
                            nature in new and novel ways, looking for light, composition, contrast and a sense dynamism
                            to capture. It's also a really good way to learn patience as often a moment needs to arise
                            even when you have found the perfect spot.</p>
                        <p>I hope you enjoy the pictures and please feel free to download them and use them however you
                            want. If you want to you can drop me an email to let me know how you used it, but if you
                            don't that's also fine.</p>
                        <p>On a coding note: I use the Blue Imp Vue component and had an interesting time figuring out
                            how to most efficiently pass the JSON from Laravel into the Vue Instance. This is passed
                            through props you define on the element and once you see this you will see it everywhere (in
                            the dev tools), Twitter also does this for instance on a hidden text-area element, something
                            I find interesting as I would have thought the would chose an element that can have an
                            onload callback.</p>
                    </div>
                </div>

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