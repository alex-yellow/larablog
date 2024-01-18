@extends('layouts.site', ['title' => $post->title])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mt-4 mb-4">
            <div class="card-header">
                <h1>{{ $post->title }}</h1>
            </div>
            <div class="card-body">
                <img src="{{ $post->image ?? asset('img/default.jpg') }}" alt="" class="img-fluid" width="400px" height="400px">
                <p class="mt-3 mb-0">{{ $post->body }}</p>
            </div>
            <div class="card-footer">
                <div class="clearfix">
                    <span class="float-left">
                        Автор: {{ $post->author->name }}
                        <br>
                        Дата: {{ date_format($post->created_at, 'd.m.Y H:i') }}
                    </span>
                    @auth
                    @if(auth()->user()->id == $post->author->id)
                    <div class="mt-2">
                        <a href="{{ route('post.edit', $post->id)}}" class="btn btn-dark float-right">Edit</a>
                        <form action="{{ route('post.delete', $post->id) }}" method="post" onsubmit="return confirm('Delete this post?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>
                    @endif
                    @else
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
