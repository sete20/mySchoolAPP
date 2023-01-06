<?php

namespace App\Http\Repositories\Web;

use DataTables;
use App\Http\Requests\web\SocialMediaPlatformRequest;
use App\Models\Socialmedia;

// use Yoeunes\Toastr\Toastr;

class SocialMediaPlatformRepository
{
    private $view_path = 'socialmedia.';
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


    public function store(SocialMediaPlatformRequest $request)
    {
        Socialmedia::create($request->except(['_token', 'image', 'password_confirmation']));
        flash()->addSuccess(trans('socialMedia.status_created_successfully'));
        return redirect()->route('socialmedia.index');
    }


    public function show(Socialmedia $socialmedia)
    {
        //
    }

    public function edit(Socialmedia $socialmedia)
    {
        return view($this->view_path . 'edit', get_defined_vars());
    }

    public function update(SocialMediaPlatformRequest $request, Socialmedia $socialmedia)
    {
        $socialmedia->update($request->except(['_token']));
        flash()->addSuccess(trans('socialMedia.status_created_successfully'));
        return redirect()->route('socialmedia.index');
    }

    public function destroy(Socialmedia $socialmedia)
    {
        $socialmedia->delete();
        flash()->addSuccess(trans('socialMedia.status_deleted_successfully'));
        return redirect()->back();
    }
    private function dataTableData()
    {
        $data = Socialmedia::get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('socialmedia.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('socialmedia.destroy', $row) . '" >
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
                    '<form   method="post" action="' . route('socialmedia.status', $row) . '" >
                    <input type="hidden" name="_method" value="post" />
                    <input name="_token" type="hidden" value="' . csrf_token() . '">
                    ' . csrf_field() . '
                        ' . $button . '
                    </form>';

                return $actions;
            })->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })->editColumn('account_url', function ($row) {
                return   '<a href="' . $row->account_url . '" class="ml-1 btn btn-sm btn-icon " __blank><i class="fa fa-eye"></i> ' . $row->platform_name . '</a>';
            })
            ->rawColumns(['actions', 'status', 'account_url'])
            ->make(true);
    }
    public function changeSocialmediaStatus(Socialmedia $socialmedia)
    {
        $status = !$socialmedia->status;
        $socialmedia->update([
            'status' => $status
        ]);
        flash()->addSuccess(trans('socialMedia.status_updated_successfully'));
        return redirect()->back();
    }
}
