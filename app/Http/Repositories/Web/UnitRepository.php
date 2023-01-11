<?php

namespace App\Http\Repositories\Web;

use App\Http\Requests\web\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitRepository
{
    private $view_path = 'unit.';
    public function index($request)
    {
        if ($request->ajax()) {
            return $this->dataTableData();
        }
        return view($this->view_path . 'index');
    }


    public function create()
    {
        return view($this->view_path . 'create');
    }


    public function store(UnitRequest $request)
    {
        Unit::create($request->all());
        flash()->addSuccess(trans('user.status_created_successfully'));
        return redirect()->route('unit.index');
    }


    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        return view($this->view_path . 'edit', get_defined_vars());
    }

    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        flash()->addSuccess(trans('user.status_updated_successfully'));
        return redirect()->route('unit.index');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        flash()->addSuccess(trans('user.status_deleted_successfully'));
        return redirect()->back();
    }
    private function dataTableData()
    {
        $data = Unit::get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('unit.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('subUnit.destroy', $row) . '" >
                <input type="hidden" name="_method" value="delete" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                <button type="submit"  class="ml-1 btn btn-sm btn-icon "><i class="fa fa-trash"></i></button>
                </form>'                    .
                    '</div>';
                return $actions;
            })->editColumn('status', function ($row) {
                if ($row->status == 0) $button = ' <button type="submit"  class="btn bt-sm  btn-success "><i class="fa fa-recycle"></i>' .  trans('general.deactive')  . '</button>';
                else  $button = ' <button type="submit"  class="btn bt-sm btn-danger "><i class="fa fa-recycle"></i>' .  trans('general.active')  . '</button>';

                $actions =
                    '<form   method="post" action="' . route('unit.status', $row) . '" >
                <input type="hidden" name="_method" value="post" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                    ' . $button . '
                </form>';

                return $actions;
            })->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })->editColumn('description', function ($row) {
                return serialize($row->description);
            })
            ->rawColumns(['actions', 'status', 'description'])
            ->make(true);
    }
    public function changeUnitStatus(Unit $unit)
    {
        $status = !$unit->status;
        $unit->update([
            'status' => $status
        ]);
        toastr()->success(trans('user.status_updated_successfully'));
        return redirect()->back();
    }
}
