@extends('layouts.app')

@section('title', 'Posts')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

    <div class="row mt-2">
        <div class="col-md-10">
            <h3>All Posts</h3>
        </div>
        <div class="col-md-2">
            <a href="{{ route('posts.create') }}" class="btn btn-block btn-primary">Create New Post</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Body</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($posts as $post)  
                        <tr>                 
                            <th>
                                <p>{{ $post->id }}</p>
                            </th>
                            <td>
                                <p><a href="/posts/{{$post->id}}">{{ $post->title }}</a></p>
                            </td>
                            <td>
                                <p>{{ $post->category->name }}</p>
                            </td>
                            <td>    
                                <p>{{ substr($post->body, 0, 50)}} {{ (strlen($post->body) > 50)?'...':''}}</p>
                            </td>
                            <td>
                                <p>{{ ($post->cover_image != null)?"True":"False" }}</p>
                            </td>
                            <td>
                                <p>{{$post->created_at}}</p>
                            </td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                            </td>
                            <td>
                                <a href="posts/{{ $post->id }}" class="btn btn-secondary">View</a>
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>  
            <div class="text-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection