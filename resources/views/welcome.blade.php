@extends ('layouts.app')

@section('content')
    <main role="main">
        <div class="album py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Portfolio</h1>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4 box-shadow"
                             onclick="location.href = '{{action('PhotoController@index')}}'">
                            <img class="card-img-top"
                                 src="{{asset('img/frontend/thumbs/das_boot_thumb.png')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Photography</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button onclick="location.href = '{{action('PhotoController@index')}}'" type="button"
                                                class="btn btn-sm btn-outline-secondary">Picture this
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4 box-shadow" onclick="location.href = '{{route('coding')}}'">
                            <img class="card-img-top"
                                 src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=4f74cfb527b697dc1c2f173034ae9be9&auto=format&fit=crop&w=1349&q=80"
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
                    <div class="col-lg-6">
                        <div class="card mb-4 box-shadow" onclick="location.href = '{{action('MusicController@index')}}'"
                             style="cursor: pointer">
                            <img class="card-img-top"
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
                    <div class="col-lg-6">
                        <div class="card mb-4 box-shadow" onclick="location.href = '{{route('about')}}'"
                             style="cursor: pointer">
                            <img class="card-img-top"
                                 src="{{asset('img/frontend/thumbs/about_thumb.jpg')}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">About me</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Loading {{date("Y")-1988}}%
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