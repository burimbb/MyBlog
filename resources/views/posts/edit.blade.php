@extends('layouts.app')

@section('title', 'Edit Post')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/select2-flat-theme.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3>Edit Post</h3>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{$post->slug}}">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{($post->category->id == $category->id)?"selected":""}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="dropdown" class="form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">Post body</label>
                    <textarea class="form-control" id="editor" name="body" rows="5">{{$post->body}}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Image to Upload</label>
                    <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Update">
                </div>
            </form>
        </div>    
    </div>    
@endsection

@section('scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        //DropDown
        $( "#dropdown" ).select2({
            theme: 'bootstrap4',
        });
        $( "#dropdown" ).select2().val( {{json_encode($post->tags()->allRelatedIds())}} ).trigger('change');

        //CKEditor
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>

    <!--$( "#dropdown" ).select2({
        theme: "flat",
        theme: 'bootstrap4',
    });-->

@endsection