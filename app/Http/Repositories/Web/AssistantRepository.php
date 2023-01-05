<?php

namespace App\Http\Repositories\Web;

use App\Models\User;
use DataTables;
use App\Http\Requests\web\AssistantRequest as request;
use App\Http\Requests\web\AssistantRequest;
// use Yoeunes\Toastr\Toastr;

class AssistantRepository
{
    private $view_path = 'assistant.';
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


    public function store(AssistantRequest $request)
    {
        $request->merge(['user_type' => 'assistant']);
        $user = User::create($request->except(['_token', 'image', 'password_confirmation']));
        if ($request->image != null) {
            $user->addMedia($request->image)->toMediaCollection('personal_image');
        }
        flash()->addSuccess(trans('user.status_created_successfully'));
        return redirect()->route('assistant.index');
    }


    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view($this->view_path . 'edit', get_defined_vars());
    }

    public function update(AssistantRequest $request, User $user)
    {
        $user->update($request->except(['_token', 'image', 'password_confirmation']));
        if ($request->image != null) {
            $user->clearMediaCollection('personal_image');
            $user->addMedia($request->image)->toMediaCollection('personal_image');
        }
        flash()->addSuccess(trans('user.status_created_successfully'));
        return redirect()->route('assistant.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        flash()->addSuccess(trans('user.status_deleted_successfully'));
        return redirect()->back();
    }
    private function dataTableData()
    {
        $data = User::where('user_type', 'assistant')->get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('assistant.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('assistant.destroy', $row) . '" >
                <input type="hidden" name="_method" value="delete" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                <button type="submit"  class="ml-1 btn btn-sm btn-icon "><i class="fa fa-trash"></i></button>
                </form>'

                    .
                    '</div>';
                return $actions;
            })->editColumn('status', function ($row) {
                if ($row->status == 0) $button = ' <button type="submit"  class="btn bt-sm  btn-success "><i class="fa fa-recycle"></i>' .  trans('admin::influencer.deactivate')  . '</button>';
                else  $button = ' <button type="submit"  class="btn bt-sm btn-danger "><i class="fa fa-recycle"></i>' .  trans('admin::influencer.active')  . '</button>';

                $actions =
                    '<form   method="post" action="' . route('assistant.status', $row) . '" >
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
        flash()->addSuccess(trans('user.status_updated_successfully'));
        return redirect()->back();
    }
}
