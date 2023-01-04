<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Repositories\Web\AssistantRepository;
use App\Http\Requests\web\AssistantRequest;

class AssistantController extends Controller
{
    public function __construct(private $repository = new AssistantRepository())
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


    public function store(AssistantRequest $request)
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

    public function update(AssistantRequest $request, User $user)
    {
        
        return $this->repository->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->repository->destroy($user);
    }
}
