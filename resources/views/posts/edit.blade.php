@extends('layouts.site', ['title' => 'Редактировать пост'])

@section('content')
    <h1 class="mt-2 mb-3">Редактировать пост</h1>
    <form method="post" action="{{ route('post.update', $post->id) }}"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title" required value="{{ old('title') ?? $post->title ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="excerpt"
                      placeholder="Subcontent" required>{{ old('excerpt') ?? $post->excerpt ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="Content" rows="7" required>{{ old('body') ?? $post->body ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="image" placeholder="Image" required value="{{ old('image') ?? $post->image ?? '' }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
