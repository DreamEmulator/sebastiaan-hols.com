<?php

namespace App\Http\Controllers;

use App\painting;
use Illuminate\Http\Request;
use ImageOptimizer;

class paintingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dream_theme = $request->session()->get('key', 'dark');
        $paintings = painting::orderBy('created_at', 'desc')->get();
        return view('paintings.paintings', ['paintings' => $paintings, 'dream_theme'=>$dream_theme]);
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
        if ($request->file('painting_pic') && $request->title && $request->subtitle) {
            $painting = new painting;
            $painting->title = $request->title;
            $painting->subtitle = $request->subtitle;
            isset($request->story) ? $painting->story = $request->story : $painting->story  = 'Spill the beans...';
            $file = $request->file('painting_pic');
            $filename = time() . $file->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $filename);
            $file->move(public_path() . '/images/', $filename);
            ImageOptimizer::optimize(public_path() . '/images/' . $filename);
            $painting->location = asset('/images/' . $filename);
            $painting->save();
            return back()->with('success', 'Information has been added');
        }
        return back()->with('fail', 'You need at least a title, an artist and a picture...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\painting  $painting
     * @return \Illuminate\Http\Response
     */
    public function show(painting $painting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\painting  $painting
     * @return \Illuminate\Http\Response
     */
    public function edit(painting $painting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\painting  $painting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->title && $request->subtitle) {
            $painting = painting::find($id);
            $painting->title = $request->title;
            $painting->subtitle = $request->subtitle;
            isset($request->story) ? $painting->story = $request->story : $painting->story  = '';

            $painting->save();
            return back()->with('success', 'Information has been updated');
        }
        return back()->with('fail', 'You need at least a title and an artist...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\painting  $painting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $painting = painting::find($id);
        $painting->delete();
        return back()->with('success','Information has been  deleted');
    }
}
