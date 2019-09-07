@extends('layouts.app')

@section('title', "Tag | $tag->name")

@section('content')
<hr>
    <div class="row">
        <div class="col-md-8">
            <h3>{{ $tag->name }} <small>{{$tag->posts()->count()}} Posts</small></h3>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-primary btn-block">Edit</a>
        </div>
        <div class="col-md-2">
            <form action="{{ route('tags.destroy',$tag->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" name="submit" id="submit" value="Delete" class="btn btn-danger btn-block">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name of Post</th>
                        <th>Tags of Post</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag->posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <span><a href="{{ route('tags.show',$tag->id) }}" class="btn btn-secondary">{{$tag->name}}</a></span>
                                @endforeach
                            </td>
                            <td><a href="{{ route('posts.show',$post->id) }}" class="btn btn-light">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection