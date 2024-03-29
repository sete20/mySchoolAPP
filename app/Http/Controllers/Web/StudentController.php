<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\StudentRepository;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(private $repository = new StudentRepository())
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


    public function store(Request $request)
    {
        return $this->repository->store($request);
    }


    public function show(User $user)
    {
        return $this->repository->show($user);
    }

    public function edit(User $user)
    {
        return $this->repository->edit($user);
    }

    public function update(Request $request, User $user)
    {
        return $this->repository->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->repository->destroy($user);
    }
    public function changeUserStatus(User $user)
    {
        return $this->repository->changeUserStatus($user);
    }
}
