@extends('layouts.app')

@section('title', 'Post | ' . substr($post->title, 0, 15).'...')

@section('stylesheet')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
@endsection
@section('content')
    <div class="row spacing-top">
        <div class="col-md-8">
            <h3>{{ $post->title }}</h3>
            <img class="w-75 blog-single-img" src="{{ ($post->cover_image == 'default.jpg')? asset('storage/images/default.jpg') : (Str::startsWith($post->cover_image,'http'))? $post->cover_image : '/storage/images/'.$post->cover_image }}" alt="">
            <div class="tags">
                <span>Tags: {{ ($post->tags->count() > 0)?"":"No Tags"}}</span>
                @foreach ($post->tags as $tag)
                    <span><a href="{{ route('tags.show',$tag->id) }}" class="btn btn-secondary">{{$tag->name}}</a></span>
                @endforeach
            </div>
            <hr>
            <p>{!! $post->body !!}</p>
        </div>
        <div class="col-md-4 blog-single-card">
            <div class="card card-body bg-light">
                <dl>
                    <p>Slug: <a href="{{ route('blog.single',$post->slug) }}">{{ route('blog.single',$post->slug) }}</a></p>
                </dl>
                <dl>
                    <dt>Category:</dt>
                    <dd>Category: {{ $post->category->name }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd>{{ date('d M Y, H:i' ,strtotime($post->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Updated at:</dt>
                    <dd>{{ date('d M Y, H:i' ,strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ $post->id }}/edit" class="btn btn-block btn-primary">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-block btn-danger" value="Delete">
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('posts.index') }}" class="btn btn-block btn-secondary"><< See All Posts</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h4>Comments <small>{{$post->comments()->count()}} total</small></h4>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post->comments()->orderBy('id','desc')->get() as $comment)
                        <tr>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" onclick="location.href='{{ route('comments.edit',$comment->id) }}'">
                                            <i class="fas fa-lg fa-edit"></i><span> View</span>
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-lg fa-trash-alt"></i><span> Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
@endsection