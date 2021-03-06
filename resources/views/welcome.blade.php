@extends ('layouts.app')
@section('extra_js')
    <script src="{{ asset('js/extra.js') }}">console.log('Bonjour')</script>
@endsection
@section('content')
    <main role="main">
        <div id="welcome-cards" class="album py-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center mb-3">
                        <h3>Digital portfolio</h3>
                        <h5 id="click-discover">Skills and interests</h5>
                        <h6 class="text-muted">Sebastiaan Hols</h6>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{action('BlogController@index')}}'">
                            <img class="card-img-top"
                                 src="{{asset('img/frontend/thumbs/bloggen_met_wim_kok.jpg')}}"
                                 alt="Card rounded-card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Blog</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Read up
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{action('PhotoController@index')}}'">
                            <img class="card-img-top h-100"
                                 src="{{asset('img/frontend/thumbs/das_boot_thumb.png')}}"
                                 alt="Card rounded-card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Photography</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button onclick="location.href = '{{action('PhotoController@index')}}'"
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary">Picture this
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{route('coding')}}'">
                            <img class="card-img-top h-100"
                                 src="{{asset('img/frontend/thumbs/coding_thumb.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Coding</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Discover
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{action('PaintingsController@index')}}'">
                            <img class="card-img-top h-100"
                                 src="https://sebastiaan-hols.com/images/1540805956IMG_3178.jpg"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Art Collection</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Picture
                                            Perfect
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{action('MusicController@index')}}'"
                             style="cursor: pointer">
                            <img class="card-img-top h-100"
                                 src="https://images.unsplash.com/photo-1522870389523-7e83c0065eaf?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=95d11688e3ff6ea4a67b67a1be698ef7&auto=format&fit=crop&w=1350&q=80"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Music</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            Tune in - Drop out
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-card mb-4 box-shadow"
                             onclick="location.href = '{{route('about')}}'"
                             style="cursor: pointer">
                            <img class="card-img-top h-100"
                                 src="{{asset('img/frontend/thumbs/about_thumb.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">About</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            Loading {{date("Y")-1988}}%
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
