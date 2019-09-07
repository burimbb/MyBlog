@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="post">
                    <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <p>{{strip_tags($post->body) }}</p>
                    <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-success">Read more</a>
                </div>
                <hr>
            @endforeach
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h3>Side Bar</h3>
        </div>
    </div>
@endsection