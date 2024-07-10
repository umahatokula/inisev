<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostPublishedEvent;
use App\Http\Requests\Post\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {

        $post = Post::create($request->all());

        // Fire new post event
        PostPublishedEvent::dispatch($post);

        return response()->json($post, 201);
    }
}
