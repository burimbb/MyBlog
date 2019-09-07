@extends('layouts.app')

@section('title', "Blog | $post->slug")

@section('content')
    <div class="row spacing-top">
        <div class="col-md-8 offset-2">
            <h4>{{$post->title}}</h4>
            <p>{{$post->body}}</p>
        </div>
        <div class="col-md-8 offset-2">
            <p><strong>Posted in: </strong>{{$post->category->name}}</p>
        </div>
        <div class="col-md-8 offset-2">
            <hr>
            @foreach ($post->comments()->orderBy('id','desc')->get() as $comment)
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name: </strong>{{$comment->name}}</p>
                    </div>
                    <div class="col-md-4 offset-2">
                        <small>posted at: {{ date('d M Y H:i:s',strtotime($comment->created_at)) }}</small>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Comment: </strong><br>{{$comment->comment}}</p>
                        <hr>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" rows="6" class="form-control"></textarea>
                        <input type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                    </div>
                </div>
            </form>
        </div>    
    </div>
@endsection