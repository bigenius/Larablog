<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Tag;
use Symfony\Component\Debug\Debug;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custom_order_by = "CASE
                              WHEN published_at IS NULL OR updated_at >= published_at 
                                  THEN  updated_at
                              ELSE  published_at
                            END 
                            DESC";
        //$posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderByRaw($custom_order_by)->get();

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

        if ($request->has('published_at')) {
            $published_at = $request->published_at;
        } else {
            $published_at = Carbon::now();
        }
        $post->published_at = $published_at;

        $user->posts()->save($post);
        $categories = $request->categories;
        if($request->has('categories') && count($categories)> 0) {
            $post->categories()->sync($categories);
        }

        if ($request->has('tags')) {
            $tagnames = explode(',', $request->tags);
            $dbtags = Tag::getTagId($tagnames);
            if (is_array($dbtags)) {
                $post->tags()->sync($dbtags);
            } elseif (is_string($dbtags)) {
                return redirect()->route('lb-admin.post.create')->with('message', array('content' => 'The tag ' . $dbtags . ' is not valid.', 'class' => 'danger'))->withInput();
            }
        }

        return redirect()->route('lb-admin.post.index')->with(['info' => 'Post created!', 'status' => 'success' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($year,$month,$slug)
    {
        $totalslug = $year .'/'.$month.'/'.$slug;
        $post = Post::where('slug',$totalslug)->first();
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
        $categories = Category::all();
        $tags = $post->tags->map( function($tag){return $tag->title;});
        $tagnames = implode(", ",$tags->toArray());

        return view('admin.post.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tagnames]);
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        $post->slug = null;
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->has('published_at')) {
            $published_at = $request->published_at;
        } else {
            $published_at = Carbon::now();
        }
        $post->published_at = $published_at;
        $post->save();

        $categories = $request->categories;
        if($request->has('categories') && count($categories) > 0) {
            $post->categories()->sync($categories);
        }

        if ($request->has('tags')) {
            $tagnames = explode(',', $request->tags);
            $dbtags = Tag::getTagId($tagnames);
            if (is_array($dbtags)) {
                $post->tags()->sync($dbtags);
            } elseif (is_string($dbtags)) {
                return redirect()->route('lb-admin.post.edit')->with('message', array('content' => 'The tag ' . $dbtags . ' is not valid.', 'class' => 'danger'))->withInput();
            }
        }

        return redirect()->back()->with(['info' => 'Post updated!', 'status' => 'success' ]);
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

    public function previewSlug(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return \Response::json($slug);

    }
}
