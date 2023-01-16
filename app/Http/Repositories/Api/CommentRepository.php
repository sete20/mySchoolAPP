<?php

namespace App\Http\Repositories\Api;

use App\Models\Comment;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\Api\LessonResource;
use App\Models\Lesson;
use App\Models\SubUnit;

class CommentRepository
{
    public function store(CommentRequest $request)
    {
        $lesson = Lesson::find($request->lesson_id)->first();
        $request->merge(['user_id' => auth()->user()->id]);
        if (in_array($lesson->sub_unit_id, SubUnit::whereIn('unit_id', auth()->user()->units->pluck('id')->toArray())->pluck('id')->toArray())) {
            Comment::create($request->all());
            return new LessonResource($lesson->load('comments'));
        } else return response()->json(['message' => 'you don\'t have an access to comment this lesson'], 403);
    }


    public function update(CommentRequest $request, Comment $comment)
    {
        $lesson = Lesson::find($request->lesson_id)->first();
        if (
            in_array($lesson->sub_unit_id, SubUnit::whereIn(
                'unit_id',
                auth()->user()->units->pluck('id')->toArray()
            )->pluck('id')->toArray())
            && auth()->user()->id == $comment->user_id
        ) {
            $comment->update(['content' => $request->content]);
            return new LessonResource($lesson->load('comments'));
        } else return response()->json(['message' => 'you don\'t have an access to comment this lesson'], 403);
        return new LessonResource($lesson->load('comments'));
    }

    public function destroy(Comment $comment)
    {
        $lesson = Lesson::find($comment->lesson_id)->first();
        if (auth()->user()->id == $comment->user_id) {
            $comment->delete();
            return response()->json([
                'message' => 'comment deleted successfully',
                new LessonResource($lesson->load('comments'))
            ], 200);
        } else return response()->json('you don\'t have access to delete this comment');
    }
}
