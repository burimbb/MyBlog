<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->with('categories', $categories)
                                    ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->tags);
        //Session::flash('success','Test');
        $validated = $request->validate([
            'title'       => 'required|max:191',
            'slug'        => 'required|alpha_dash|min:5|max:191|unique:posts,slug',
            'category_id' => 'required|numeric',
            'body'        => 'required|max:4000',
            'cover_image' => 'image|nullable|max:3999',
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.jpg';
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        $post->cover_image = $fileNameToStore;
        $post->save();

        $post->tags()->sync($request->tags, false);

        return redirect('/posts')->with('success', 'Your post saved !');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit')->withPost($post)
                                ->withCategories($categories)
                                ->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($post->slug == $request->slug) {
            $validated = $request->validate([
                'title'       => 'required|max:191',
                'body'        => 'required|max:4000',
                'category_id' => 'required|numeric',
                'cover_image' => 'image|nullable|max:3999',
            ]);
        } else {
            $validated = $request->validate([
                'title'       => 'required|max:191',
                'slug'        => 'required|alpha_dash|min:5|max:191|unique:posts,slug',
                'category_id' => 'required|numeric',
                'body'        => 'required|max:4000',
                'cover_image' => 'image|nullable|max:3999',
            ]);
        }

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/images', $fileNameToStore);
        }

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        if ($request->hasFile('cover_image')) {
            if ($post->cover_image != 'default.jpg') {
                Storage::delete('public/images'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        $post->tags()->sync($request->tags);

        return redirect('/posts/'.$id)->with('success', 'Your post edited !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();
        $post->delete();

        return redirect('/posts')->with('success', 'Your post has been deleted !');
    }
}
