@extends('layouts.app')

@section('title', "Edit | $tag->name")

@section('content')
<hr>
    <div class="row">
        <div class="col-md-6 offset-3">
            <form action="{{ route('tags.update',$tag->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="tag_name">Name:</label>
                <input type="text" name="tag_name" id="tag_name" value="{{$tag->name}}" class="form-control">
                <hr>
                <input type="submit" name="submit" id="submit" class="form-control btn btn-block btn-success" value="Update Tag">
            </form>
        </div>
    </div>
@endsection