<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\UnitRepository;
use App\Http\Requests\web\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct(private $repository = new UnitRepository())
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


    public function store(UnitRequest $request)
    {
        return $this->repository->store($request);
    }


    public function show(Unit $unit)
    {
        return $this->repository->show($unit);
    }

    public function edit(Unit $unit)
    {
        return $this->repository->edit($unit);
    }

    public function update(UnitRequest $request, Unit $unit)
    {
        return $this->repository->update($request, $unit);
    }

    public function destroy(Unit $unit)
    {
        return $this->repository->destroy($unit);
    }
    public function changeUnitStatus(Unit $unit)
    {
        return $this->repository->changeUnitStatus($unit);
    }
}
