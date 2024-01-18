<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'show', 'search');
    }

    public function index()
    {
        $posts = Post::select('posts.*', 'users.name as author')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request) {
        $search = $request->input('search', '');
        $search = iconv_substr($search, 0, 64);
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        $search = preg_replace('#\s+#u', ' ', $search);
        if (empty($search)) {
            return view('posts.search');
        }
        $posts = Post::select('posts.*', 'users.name as author')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->where('posts.title', 'like', '%'.$search.'%')
            ->orWhere('posts.body', 'like', '%'.$search.'%')
            ->orWhere('users.name', 'like', '%'.$search.'%')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(4)
            ->appends(['search' => $request->input('search')]);;
        return view('posts.search', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
     {
        $post = new Post();
        $post->author_id = Auth::id();
        $post->title = $request->input('title');
        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');
        $post->image = $request->input('image');
        $post->save();
        return redirect()->route('post.index')->with('success', 'The post was successfully create');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (Auth::id() != $post->author_id) {
            return redirect()
                ->route('post.index')
                ->withErrors('You can only edit your posts');
        }
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        if (Auth::id() != $post->author_id) {
            return redirect()
                ->route('post.index')
                ->withErrors('You can only edit your posts');
        }
        $post->title = $request->input('title');
        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');
        $post->image = $request->input('image');
        $post->update();
        return redirect()
            ->route('post.show', compact('post'))
            ->with('success', 'The post was successfully update');
    }

    public function delete(Post $post)
    {
        if (Auth::id() != $post->author_id) {
            return redirect()
                ->route('post.index')
                ->withErrors('You can only delete your posts');
        }
        $post->delete();
        return redirect()->route('post.index')->with('success', 'The post was successfully deleted');
    }
}
