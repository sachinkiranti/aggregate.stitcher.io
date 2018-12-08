<?php

namespace App\Http\Controllers;

use App\Domain\Post\Events\AddViewEvent;
use App\Http\Queries\PostsQuery;
use Domain\Post\Actions\AddViewAction;
use Domain\Post\Models\Post;
use Illuminate\Http\Request;

class PostsController
{
    public function index(
        Request $request,
        PostsQuery $query
    ) {
        $posts = $query->paginate();

        $posts->appends($request->except('page'));

        return view('posts.index', [
            'posts' => $posts,
            'user' => $request->user(),
        ]);
    }

    public function show(
        Request $request,
        Post $post
    ) {
        event(AddViewEvent::create($post, $request->user()));

        return redirect()->to($post->url);
    }
}