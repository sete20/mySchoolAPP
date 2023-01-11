<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\LessonRepository;
use App\Http\Requests\web\LessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(private $repository = new LessonRepository())
    {
    }
    public function index(Request $r)
    {
        return $this->repository->index($r);
    }
    public function create()
    {
        return $this->repository->create();
    }
    public function store(LessonRequest $request)
    {
        return $this->repository->store($request);
    }
    public function show(Lesson $lesson)
    {
        return $this->repository->show($lesson);
    }

    public function edit(Lesson $lesson)
    {
        return $this->repository->edit($lesson);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        return $this->repository->update($request, $lesson);
    }

    public function destroy(Lesson $lesson)
    {
        return $this->repository->destroy($lesson);
    }
    public function changeLessonStatus(Lesson $lesson)
    {
        return $this->repository->changeLessonStatus($lesson);
    }
}
