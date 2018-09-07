<?php

namespace App\Http\Controllers;

use App\photo;
use App\skills;
use Illuminate\Http\Request;
use ImageOptimizer;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dream_theme = $request->session()->get('key', 'dark');
        $photos = photo::all();
        $skills = skills::orderBy('created_at', 'desc')->first();
        return view('photos.photolibrary', ['photos' => $photos, 'skills' => $skills, 'dream_theme'=>$dream_theme]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('photo') && $request->title && $request->text) {
            $photo = new photo;
            $photo->title = $request->title;
            $photo->text = $request->text;
            $file = $request->file('photo');
            $filename = time() . $file->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $filename);
            $file->move(public_path() . '/images/', $filename);
            ImageOptimizer::optimize(public_path() . '/images/' . $filename);
            $photo->location = asset('/images/' . $filename);
            $photo->save();
            return redirect('photos')->with('success', 'Information has been added');
        }
        return redirect('photos')->with('fail', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = photo::find($id);
        $photo->title=$request->title;
        $photo->text=$request->text;
        $photo->save();
        return redirect('photos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = photo::find($id);
        $photo->delete();
        return redirect('photos')->with('success','Information has been  deleted');
    }
}
