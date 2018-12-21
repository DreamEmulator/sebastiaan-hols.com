<?php

namespace App\Http\Controllers;

use App\blog;
use Illuminate\Http\Request;
use ImageOptimizer;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dream_theme = $request->session()->get('key', 'dark');
        $blogs = blog::orderBy('created_at', 'desc')->get();
        return view('blog.blog', ['blogs' => $blogs, 'dream_theme'=>$dream_theme]);
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
        if ($request->file('blog_pic') && $request->title && $request->subtitle && $request->story) {
            $blog = new blog;
            $blog->title = $request->title;
            $blog->subtitle = $request->subtitle;
            $blog->story = $request->story;
            $file = $request->file('blog_pic');
            $filename = time() . $file->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $filename);
            $file->move(public_path() . '/images/', $filename);
            ImageOptimizer::optimize(public_path() . '/images/' . $filename);
            $blog->location = asset('/images/' . $filename);
            $blog->save();
            return back()->with('success', 'Information has been added');
        }
        return back()->with('fail', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->title && $request->subtitle && $request->story) {
            $blog = blog::find($id);
            $blog->title = $request->title;
            $blog->subtitle = $request->subtitle;
            $blog->story = $request->story;

            $blog->save();
            return back()->with('success', 'Information has been updated');
        }
        return back()->with('fail', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = blog::find($id);
        $blog->delete();
        return back()->with('success','Information has been  deleted');
    }
}
