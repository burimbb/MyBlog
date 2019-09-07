@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="row spacing-top">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="post">
                    <h3><a href="{{ route('blog.single', $post->slug) }}">{{$post->title}}</a></h3>
                    <p>{{ substr($post->body,0,200)}} {{ (strlen($post->body) > 200)?"...":"" }}</p>
                    <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-success">Read more</a>
                </div>
                <hr>
            @endforeach
            <div class="row">{{ $posts->links() }}</div>
        </div>
    </div>    
@endsection