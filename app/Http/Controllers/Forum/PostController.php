<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\CreatePostFormRequest;
use App\Transformers\PostTransformer;

class PostController extends Controller
{
    public function store(CreatePostFormRequest $request, Topic $topic)
    {
        $post = $topic->posts()->create([
            'body' => $request->json('body'),
            'user_id' => $request->user()->id,
        ]);

        return fractal()
            ->item($post)
            ->includeUser()
            ->transformWith(new PostTransformer)
            ->toArray();
    }
}
