@extends('layouts.app')

@section('title', 'Comment | Edit')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <h3>Edit Comment</h3>
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$comment->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$comment->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" rows="5" class="form-control">{{$comment->comment}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Update">
                </div>
            </form>
        </div>    
    </div>   
@endsection
