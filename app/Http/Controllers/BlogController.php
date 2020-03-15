<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getSlug($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        //$comments = Comment::where('post_id',$post->id)->get();
        //dd($comments);
        return view('blog.single')->withPost($post);
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('blog.index')->withPosts($posts);
    }
}
