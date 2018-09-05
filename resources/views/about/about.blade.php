@extends('layouts.app')
@section('content')

    <div class="container marketing">

        <div class="row justify-content-center">
            <div class="col-lg-4 text-center">
                <img class="rounded-circle mb-4" src="{{asset('/img/frontend/about/prof3.jpg')}}"
                     alt="Generic placeholder image" width="140" height="140">
                <h3>Sebastiaan Hols</h3>
                <h5>Designer + Developer</h5>
            </div>
        </div>
        <hr class="featurette-divider m-4">
        <div class="row featurette">
            <div class="col-md-7">
                <h3 class="featurette-heading">Designer</h3>
                <span class="text-muted">Photo's, Video's, Publications</span>
                <p class="lead">From a young age there has always been a passion for creating and designing, new and
                    interesting visual concepts.</p>
                <p class="lead">Good design balances between information and looks. I enjoy working on projects that
                    combine all facets of digital media from photography to video, desktops to dev-servers.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto"
                     src="{{asset('/img/frontend/about/age_of_innocence.jpg')}}" alt="Age of innocence">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h3 class="featurette-heading">Developer</h3>
                <span class="text-muted">HTML, SCSS, JS, PHP</span>
                <p class="lead">Nowadays I love to combine developing web applications with media design. Using frameworks such as Laravel and Vue allows me too quickly and easily leverage the power of the web to connect the creativity.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" src="{{asset('/img/frontend/about/reality.jpg')}}"
                     alt="Age of Discovery">
            </div>
        </div>
    </div>


@endsection