@extends('layouts.site')

@section('content')
<h1 class="mt-2 mb-3">All blog posts</h1>
<div class="row">
    @foreach ($posts as $post)
    <div class="col-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>{{ $post->title }}</h3>
            </div>
            <div class="card-body">
                <img src="{{ $post->image ?? asset('img/default.jpg') }}" alt="" class="img-fluid" width="400px" height="400px">
                <p class="mt-3 mb-0">{{ $post->excerpt }}</p>
            </div>
            <div class="card-footer">
                <div class="clearfix">
                    <span class="float-left">
                        Author: {{ $post->author }}
                        <br>
                        Date: {{ date_format($post->created_at, 'd.m.Y H:i') }}
                    </span>
                    <div class="mt-2">
                        <a href="{{ route('post.show', $post->id)}}" class="btn btn-dark float-right">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="links">
    {{ $posts->links() }}
</div>
@endsection
