<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PageController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->limit(10)->get();
        return view('pages.home')->withPosts($posts);
    }

    public function about(){
        return view('pages.about');
    }

    public function contact(){
        return view('pages.contact');
    }
}
