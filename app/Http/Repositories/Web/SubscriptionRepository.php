<?php

namespace App\Http\Repositories\Web;

use App\Http\Requests\web\SubscriptionRequest;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Unit;

class SubscriptionRepository
{
    private $view_path = 'subscription.';
    public function index($request)
    {
        if ($request->ajax()) {
            return $this->dataTableData();
        }
        return view($this->view_path . 'index');
    }



    public function create()
    {
        $units = Unit::where('status', 1)->get();
        return view($this->view_path . 'create', get_defined_vars());
    }


    public function store(SubscriptionRequest $request)
    {
        $subscription =  Subscription::create($request->except('units_id'));
        $subscription->units()->attach($request->units_id);
        flash()->addSuccess(trans('user.status_created_successfully'));
        return redirect()->route('subscription.index');
    }


    public function show(Subscription $subscription)
    {
        //
    }

    public function edit(Subscription $subscription)
    {
        $units = Unit::where('status', 1)->get();
        return view($this->view_path . 'edit', get_defined_vars());
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->except('units_id'));
        $subscription->units()->sync($request->units_id);
        flash()->addSuccess(trans('user.status_updated_successfully'));
        return redirect()->route('subscription.index');
    }
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        flash()->addSuccess(trans('user.status_deleted_successfully'));
        return redirect()->route('subscription.index');
    }
    private function dataTableData()
    {
        $data = Subscription::get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('subscription.show', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-eye"></i></a>' .
                    '<a href="' . route('subscription.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('subscription.destroy', $row) . '" >
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
                    '<form   method="post" action="' . route('subscription.status', $row) . '" >
                <input type="hidden" name="_method" value="post" />
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                  ' . csrf_field() . '
                    ' . $button . '
                </form>';

                return $actions;
            })->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })->editColumn('description', function ($row) {
                return substr(serialize($row->description), 0, 30);
            })
            ->rawColumns(['actions', 'status', 'description'])
            ->make(true);
    }
    public function changeSubscriptionStatus(Subscription $subscription)
    {
        $status = !$subscription->status;
        $subscription->update([
            'status' => $status
        ]);
        toastr()->success(trans('admin::user.status_updated_successfully'));
        return redirect()->back();
    }
}
