<?php

namespace App\Http\Requests\Web;

use App\Models\Lesson;
use App\Models\SubUnit;
use Illuminate\Foundation\Http\FormRequest;

class SocialMediaPlatformRequest extends FormRequest
{
    private $view_path = 'lesson.';
    public function index($request)
    {
        if ($request->ajax()) {
            return $this->dataTableData();
        }
        return view($this->view_path . 'index');
    }
    public function create()
    {
        $sub_units = SubUnit::where('status', 1)->get();
        return view($this->view_path . 'create', get_defined_vars());
    }


    public function store(LessonRequest $request)
    {
        Lesson::create($request->all());
        flash()->addSuccess(trans('user.status_created_successfully'));
        return redirect()->route('Lesson.index');
    }


    public function show(Lesson $lesson)
    {
        //
    }

    public function edit(Lesson $lesson)
    {
        $units = Unit::where('status', 1)->get();
        return view($this->view_path . 'edit', get_defined_vars());
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());
        flash()->addSuccess(trans('user.status_updated_successfully'));
        return redirect()->route('Lesson.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        flash()->addSuccess(trans('user.status_deleted_successfully'));
        return redirect()->back();
    }
    private function dataTableData()
    {
        $data = Lesson::get();
        return DataTables()->of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $actions =
                    '  <div class="btn-group" role="group" aria-label="Basic example">' .
                    '<a href="' . route('Lesson.edit', $row) . '" class="ml-1 btn btn-sm btn-icon "><i class="fa fa-edit"></i></a>' .

                    '<form  class="ml-3" method="post" action="' . route('Lesson.destroy', $row) . '" >
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
                    '<form   method="post" action="' . route('Lesson.status', $row) . '" >
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
            ->editColumn('sub_unit_name', function ($row) {
                return $row->unit->title;
            })
            ->rawColumns(['actions', 'status', 'description'])
            ->make(true);
    }
    public function changeUnitStatus(Lesson $lesson)
    {
        $status = !$lesson->status;
        $lesson->update([
            'status' => $status
        ]);
        toastr()->success(trans('user.status_updated_successfully'));
        return redirect()->back();
    }
}
