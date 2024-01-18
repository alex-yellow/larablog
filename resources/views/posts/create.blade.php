@extends('layouts.site', ['title' => 'Create Post'])

@section('content')
    <h1 class="mt-2 mb-3">Create Post</h1>
    <form method="post" action="{{ route('post.store') }}">
        @csrf
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="title" placeholder="Title" required value="{{ old('title') ?? '' }}">
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" name="excerpt" placeholder="Subcontent" required>{{ old('excerpt') ?? '' }}</textarea>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" name="body" placeholder="Content" rows="7" required>{{ old('body') ?? '' }}</textarea>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="image" placeholder="Image" value="{{ old('image') ?? '' }}">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
