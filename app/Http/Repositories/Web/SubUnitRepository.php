<?php

namespace App\Http\Repositories\Web;

use Illuminate\Http\Request;
use App\Models\SubUnit;

class SubUnitRepository
{
    private $view_path = 'package.';
    public function index($request)
    {
        if ($request->ajax()) {
            return $this->dataTableData();
        }
        return view($this->view_path . 'index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(SubUnit $subUnit)
    {
        //
    }

    public function edit(SubUnit $subUnit)
    {
        //
    }

    public function update(Request $request, SubUnit $subUnit)
    {
        //
    }

    public function destroy(SubUnit $subUnit)
    {
        //
    }

    private function dataTableData()
    {
        $data = SubUnit::get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('subUnit.show', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-eye"></i></a>' .
                    '<a href="' . route('subUnit.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('subUnit.destroy', $row) . '" >
                <input type="hidden" name="_method" value="delete" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                <button type="submit"  class="ml-1 btn btn-sm btn-icon "><i class="fa fa-trash"></i></button>
                </form>'

                    .
                    '</div>';
                return $actions;
            })->editColumn('status', function ($row) {
                if ($row->status == 0) $button = ' <button type="submit"  class="btn bt-sm  btn-success "><i class="fa fa-recycle"></i>' .  trans('admin::influencer.deactive')  . '</button>';
                else  $button = ' <button type="submit"  class="btn bt-sm btn-danger "><i class="fa fa-recycle"></i>' .  trans('admin::influencer.active')  . '</button>';

                $actions =
                    '<form   method="post" action="' . route('dashboard.change.user.status', $row) . '" >
                <input type="hidden" name="_method" value="post" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                    ' . $button . '
                </form>';

                return $actions;
            })->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }
    public function changeUserStatus(User $user)
    {
        $status = !$user->status;
        $user->update([
            'status' => $status
        ]);
        toastr()->success(trans('admin::user.status_updated_successfully'));
        return redirect()->back();
    }
}
