<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\SectionTransformer;

class SectionController extends Controller
{
    public function index(Section $section)
    {
        return fractal()
            ->collection($section->get())
            ->transformWith(new SectionTransformer)
            ->toArray();
    }
}
