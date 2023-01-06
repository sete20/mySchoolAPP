<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\SocialMediaPlatformRepository;
use App\Http\Requests\Web\SocialMediaPlatformRequest;
use App\Models\Socialmedia;
use Illuminate\Http\Request;

class SocialMediaPlatformController extends Controller
{
    public function __construct(private $repository = new SocialMediaPlatformRepository())
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


    public function store(SocialMediaPlatformRequest $request)
    {
        return $this->repository->store($request);
    }


    public function show(Socialmedia $socialmedia)
    {
        return $this->repository->show($socialmedia);
    }

    public function edit(Socialmedia $socialmedia)
    {
        return $this->repository->edit($socialmedia);
    }

    public function update(SocialMediaPlatformRequest $request, Socialmedia $socialmedia)
    {
        return $this->repository->update($request, $socialmedia);
    }

    public function destroy(Socialmedia $socialmedia)
    {
        return $this->repository->destroy($socialmedia);
    }
    public function changeSocialmediaStatus(Socialmedia $socialmedia)
    {
        return $this->repository->changeSocialmediaStatus($socialmedia);
    }
}
