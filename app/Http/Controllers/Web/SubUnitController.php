<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\SubUnitRepository;
use App\Http\Requests\web\SubUnitRequest;
use App\Models\SubUnit;
use Illuminate\Http\Request;

class SubUnitController extends Controller
{
    public function __construct(private $repository = new SubUnitRepository())
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
    public function store(SubUnitRequest $request)
    {
        return $this->repository->store($request);
    }
    public function show(SubUnit $subUnit)
    {
        return $this->repository->show($subUnit);
    }

    public function edit(SubUnit $subUnit)
    {
        return $this->repository->edit($subUnit);
    }

    public function update(SubUnitRequest $request, SubUnit $subUnit)
    {
        return $this->repository->update($request, $subUnit);
    }

    public function destroy(SubUnit $subUnit)
    {
        return $this->repository->destroy($subUnit);
    }
    public function changeSubUnitStatus(SubUnit $subUnit)
    {
        return $this->repository->changeUnitStatus($subUnit);
    }
}
