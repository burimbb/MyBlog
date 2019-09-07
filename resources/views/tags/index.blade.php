@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>        
                            <td>{{ $tag->id }}</td>
                            <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card card-body bg-light">
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <h4>Tag</h4>
                    <label for="category_name">Name:</label>
                    <input type="text" name="tag_name" id="tag_name" class="form-control">
                    <hr>
                    <input type="submit" value="Create new Tag" class="btn btn-block btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection