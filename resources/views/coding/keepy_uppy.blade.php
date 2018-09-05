@extends('layouts.app')
@section('extra_js')
    <script src="https://unpkg.com/popmotion@8.2.1/dist/popmotion.global.min.js"></script>
    <script src="{{ URL::asset('js/popmotion/keepy_uppy.js') }}" defer></script>
@endsection
@section('extra_style')
    <style>

        .navbar {
            z-index: 1;
        }

        #keepy-uppy {
            bottom: 5px;
            align-items: flex-end;
            position: fixed;

        }

        .ball {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f;
            height: 15vmin;
            width: 15vmin;
            min-height: 100px;
            min-width: 100px;
            border-radius: 50%;
            color: white;
            font-weight: 700;
            font-size: 3vmin;
            transform-origin: 50% 100%;
        }

        h3 {
            font-size: 10vmin;
            user-select: none;
        }

        footer {
            display: none;
        }
    </style>
@endsection
@section('non_vue')
    <div class="container">
        <div class="row">
            <div id="keepy-uppy" class="d-flex w-100 h-100 justify-content-center">
                <div class="ball"><h3></h3></div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <popmotion-ball-score @if(Session::has('highscore')):last_highscore="{{Session::get('highscore')}}"@else:last_highscore="0"@endif></popmotion-ball-score>
@endsection

