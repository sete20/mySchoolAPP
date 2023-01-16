<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Repositories\Api\CommentRepository;
use App\Models\Lesson;

class CommentController extends Controller
{
    public function __construct(private $repository = new CommentRepository())
    {
    }

    public function store(CommentRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        return $this->repository->update($request, $comment);
    }

    public function destroy(Comment $comment)
    {
        return $this->repository->destroy($comment);
    }
}
