<?php

namespace App\Http\Repositories\Web;

use Illuminate\Http\Request;
use App\Models\User;

class StudentRepository
{
    private $view_path = 'student.';
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


    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        $user->delete();
        flash()->addSuccess(trans('user.status_deleted_successfully'));
        return redirect()->back();
    }
    private function dataTableData()
    {
        $data = User::where('user_type', 'student')->get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    // '<a href="' . route('student.show', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-eye"></i></a>' .
                    // '<a href="' . route('student.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('student.destroy', $row) . '" >
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
                    '<form   method="post" action="' . route('student.status', $row) . '" >
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
        toastr()->success(trans('user.status_updated_successfully'));
        return redirect()->back();
    }
}
