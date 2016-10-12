<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Topic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\CreateTopicFormRequest;
use App\Http\Requests\Forum\GetTopicsFormRequest;
use App\Transformers\TopicTransformer;

class TopicController extends Controller
{
    public function index(GetTopicsFormRequest $request, Section $section)
    {
        $topics = $section->find($request->get('section_id'))->topics()->latestFirst()->get();

        return fractal()
            ->collection($topics)
            ->includeUser()
            ->transformWith(new TopicTransformer)
            ->toArray();
    }

    public function show(Topic $topic)
    {
        return fractal()
            ->item($topic)
            ->includeUser()
            ->includePosts()
            ->includeSection()
            ->transformWith(new TopicTransformer)
            ->toArray();
    }

    public function store(CreateTopicFormRequest $request)
    {
        $topic = $request->user()->topics()->create([
            'title' => $request->json('title'),
            'slug' => str_slug($request->json('title')),
            'body' => $request->json('body'),
            'section_id' => $request->json('section_id'),
        ]);

        return fractal()
            ->item($topic)
            ->includeUser()
            ->includeSection()
            ->transformWith(new TopicTransformer)
            ->toArray();
    }
}
