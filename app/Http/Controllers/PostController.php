<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use App\Tag;
use Symfony\Component\Debug\Debug;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->get();

        return view('admin.post.list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = new Post([
            'title' => $request->title,
            'body' => $request->body,
            ]);
        $user->posts()->save($post);
        $categories = $request->categories;
        if($request->has('categories') && $categories->count > 0) {
            $post->categories()->sync($categories);
        }

        if ($request->has('tags')) {
            $tagnames = explode(',', $request->tags);
            $dbtags = Tag::getTagId($tagnames);
            if (is_array($dbtags)) {
                $post->tags()->sync($dbtags);
            } elseif (is_string($dbtags)) {
                return Redirect::route('lb-admin.post.create')->with('message', array('content' => 'The tag ' . $dbtags . ' is not valid.', 'class' => 'danger'))->withInput();
            }
        }

        return redirect()->back()->with(['info' => 'Check created!', 'status' => 'success' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($year,$month,$slug)
    {
        $post = Post::findBySlugOrId($slug);
        
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
