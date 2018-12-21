<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use ImageOptimizer;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->file('post_pic') && $request->title && $request->subtitle && $request->story) {
            $post = new post;
            $post->title = $request->title;
            $post->subtitle = $request->subtitle;
            $post->story = $request->story;
            $file = $request->file('post_pic');
            $filename = time() . $file->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $filename);
            $file->move(public_path() . '/images/', $filename);
            ImageOptimizer::optimize(public_path() . '/images/' . $filename);
            $post->location = asset('/images/' . $filename);
            $post->save();
            return back()->with('success', 'Information has been added');
        }
        return back()->with('fail', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();
        return back()->with('success','Information has been  deleted');
    }
}
