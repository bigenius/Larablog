<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();

        return view('admin.comment.list', ['comments' => $comments]);
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
    public function store(Request $request, $id)
    {
        //md5( strtolower( trim( "email" ) ) );
        $this->validate($request, [
            'author_email' => 'required|email',
            'author_name' => 'required|alpha_dash',
            'body' => 'required|string',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
        


        $comment = new Comment();
        $comment->author_email = $request->author_email;
        $comment->author_name = $request->author_name;
        $comment->body = $request->body;
        $comment->author_email_hash = md5( strtolower( trim( $request->author_email ) ) );
        $post = Post::find($id);
        $post->comments()->save($comment);
        return response()->json(['status' => 'Comment saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('lb-admin.comment.index')->with(['info' => 'Comment deleted!', 'status' => 'warning' ]);
    }

    public function approve(Comment $comment)
    {
        $comment->approved = true;
        $comment->save();
        return redirect()->route('lb-admin.comment.index')->with(['info' => 'Comment approved!', 'status' => 'success' ]);
    }


}
