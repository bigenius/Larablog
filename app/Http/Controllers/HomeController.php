<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Type\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::whereNotNull('published_at')->orderBy('published_at', 'desc')->simplePaginate(15);
        $categories = Category::has('posts')->get();
        $tags = Tag::has('posts')->get();
        return view('home', compact('posts', 'categories','tags'));
    }
}
