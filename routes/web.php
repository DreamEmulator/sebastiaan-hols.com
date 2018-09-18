<?php

	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/

//Admin Routes
	Route::get('/manage', function ()
	{
		return view('auth.manageprofiles');
	})->middleware('is_admin')->name('manage');


	Route::get('/photos/add', function (App\photo $photos)
	{
		return view('photos.addphoto');
	})->middleware('is_admin')->name('add_photos');

	Route::get('/photos/manage', function (App\photo $photos)
	{
		$photos = $photos::all();

		return view('photos.managephotos', ['photos' => $photos]);
	})->middleware('is_admin')->name('manage_photos');

	Route::get('/music/add', function(App\music $music){
		return view('music.addmusic');
	})->middleware('is_admin')->name('add_music');

	Route::get('/music/manage', function (App\music $music)
	{
		$musics = $music::all();

		return view('music.managemusic', ['musics' => $musics]);
	})->middleware('is_admin')->name('manage_music');

	Route::resource('skills', 'SkillsController');

//Global Routes
	Auth::routes();

	Route::post('/dream_theme', 'ThemeController@changeTheme')->name('change_theme');

	Route::get('/', function ()
	{
		return view('welcome');
	});

	Route::get('/about', function (App\skills $skills, App\post $post)
	{
	    $posts = $post::all();
        $skills = $skills::orderBy('created_at', 'desc')->first();
		return view('about.about',['skills' => $skills,'posts' => $posts]);
	})->name('about');

	Route::resource('photos', 'PhotoController');

	Route::resource('music', 'MusicController');

	Route::resource('posts', 'PostController');

	Route::get('/coding', function (App\skills $skills)
	{
	    $skills = $skills::orderBy('created_at', 'desc')->first();
		return view('coding.codelibrary',['skills' => $skills]);
	})->name('coding');

	Route::get('/coding/keepy-uppy', function ()
	{
		return view('coding.keepy_uppy');
	})->name('keepy-uppy');

	Route::get('/highscore/{highscore}', function ($highscore)
	{
		session(['highscore' => $highscore]);

		return $highscore;
	});