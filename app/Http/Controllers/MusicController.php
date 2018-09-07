<?php

//TODO Finish Music posts
//Change migration name and capitalize controller

namespace App\Http\Controllers;

use App\music;
use App\skills;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    $dream_theme = $request->session()->get('key', 'dark');
	    $musics = music::all()->sortBy('title');
        $skills = skills::orderBy('created_at', 'desc')->first();
	    return view('music.musiclibrary', ['musics' => $musics, 'skills' => $skills, 'dream_theme'=>$dream_theme]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $music = new music;
	    $music->title = $request->title;
	    $music->text = $request->text;
	    $music->img_location = $request->img_location;
	    $music->spotify = $request->spotify;
	    $music->tidal = $request->tidal;
	    $music->muziekweb = $request->muziekweb;
	    $music->save();
	    return redirect('music')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
	    $music = music::find($id);
	    $music->title = $request->title;
	    $music->img_location = $request->img_location;
	    $music->text = $request->text;
	    $music->spotify = $request->spotify;
	    $music->tidal = $request->tidal;
	    $music->muziekweb = $request->muziekweb;
	    $music->save();
	    return redirect('music');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $music = music::find($id);
	    $music->delete();
	    return redirect('music')->with('success','Information has been  deleted');
    }
}
