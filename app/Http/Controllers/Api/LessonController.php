<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LessonResource;
use App\Models\Lesson;
use App\Models\SubUnit;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Lesson $lesson)
    {
        if (in_array($lesson->sub_unit_id, SubUnit::whereIn('unit_id', auth()->user()->units->pluck('id')->toArray())->pluck('id')->toArray())) return new LessonResource($lesson->load('comments'));
        else return response()->json(['message' => 'you don\'t have an access to watch this lesson'], 403);
    }
}
