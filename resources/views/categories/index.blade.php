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
                    @foreach ($categories as $category)
                        <tr>        
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card card-body bg-light">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <h4>Category</h4>
                    <label for="category_name">Name:</label>
                    <input type="text" name="category_name" id="category_name" class="form-control">
                    <hr>
                    <input type="submit" value="Create new Category" class="btn btn-block btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection