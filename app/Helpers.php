<?php

use App\Jobs\UploadAttachmentsAndVideosJob;
use Illuminate\Support\Facades\File;

if (!function_exists('upload_files')) {
    function upload_files($video, $attachments = null, $model)
    {
        $model->addMedia($video)->toMediaCollection('video');
        if ($attachments != null) {
            foreach ($attachments as $attachment) {
                $model->addMedia($attachment)->toMediaCollection('attachments');
            }
        }
    }
}

function InvokeControllerFile($model, $namespace)
{
    return
        $fileContents =
        '
        <?php
        namespace App\Http\Controllers\\' . $namespace . ';
        use App\Http\Controllers\Controller;
        use App\Models\\' . $model . ' ;
        use App\Http\Requests\\' . $namespace . '\\' . $model . 'Request;
        use App\Http\Repositories\\' . $namespace . '\\' . $model . 'Repository;

        class ' . $model . 'Controller extends Controller{
        public function __construct(private $repository = new ' . $model . 'Repository()){}

        public function __invoke(' . $model . 'Request $request, ' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->logic($request, $' .   strtolower($model) . ');
        }
    }
        ';
}
function InvokeRepositoryFile($model, $namespace)
{
    return
        $fileContents =
        '
    <?php

    namespace App\\Http\\Repositories\\' . $namespace . ';
    use App\\Models\\' . $model . ';
    use App\Http\Requests\\' . $namespace . '\\' . $model . 'Request;

    class ' . $model . 'Repository {
        public function logic(' . $model . 'Request $request)
        {
        }

    }';
}
function RequestFile($model, $namespace)
{
    return
        $fileContents = '
    <?php

    namespace App\Http\Requests\\' . $namespace . ' ;
    use App\Http\Requests\Concerns\WithHashedPassword;
    use App\Rules\isValidPassword;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\Password;
    class ' . $model . 'Request extends FormRequest{
        use WithHashedPassword;

        public function authorize()
        {
            return true;
        }
        public function rules()
        {

            if ($this->isMethod("POST")) return $this->store();
            elseif ($this->isMethod("PUT")) return $this->update();
        }
         function update()
        {
            return [

            ];
        }
        function store()
        {
            return [];
        }
    }

            ';
}


function WebRepositoryFile($model, $namespace)
{
    mkdir('resources/views/' . strtolower($model), 7777, true);
    File::copy('resources/views/base_views/create.blade.php', 'resources/views/' . strtolower($model) . '/create.blade.php');
    File::copy('resources/views/base_views/index.blade.php', 'resources/views/' . strtolower($model) . '/index.blade.php');
    File::copy('resources/views/base_views/edit.blade.php', 'resources/views/' . strtolower($model) . '/edit.blade.php');
    return
        $fileContents = '
    <?php

    namespace App\\Http\\Repositories\\' . $namespace . ';
    use App\\Models\\' . $model . ';
    use App\Http\Requests\Web\\' . $model . 'Request;
    use DataTables;

    class ' . $model . 'Repository {
                    private $view_path = "' . strtolower($model) . '.' . '";
                    public function index($request)
                    {
                        if ($request->ajax()) {
                            return $this->dataTableData();
                        }
                        return view($this->view_path . "index");
                    }
                    public function create()
                    {
                        return view($this->view_path . "create",get_defined_vars());
                    }
                    public function store(' . $model . 'Request $request)
                    {
                        $model =' . $model . '::create($request->allWithHashedPassword());
                        flash()->addSuccess(trans("user.status_created_successfully"));
                        return redirect()->route("assistant.index");
                    }

                    public function show(' . $model . ' $' . strtolower($model) . ')
                    {
                        //
                    }
                    public function edit(' . $model . ' $' . strtolower($model) . ')
                    {
                        return view($this->view_path . "edit", get_defined_vars());
                    }
                    public function update(' . $model . 'Request $request, ' . $model . ' $' .  strtolower($model) . ')
                    {
                        //
                    }

                    public function destroy(' . $model . ' $' . strtolower($model) . ')
                    {
                        $' .  strtolower($model) . '->delete();
                        return response()->json();
                    }
                        function dataTableData()
                    {
                    $data = ' . $model . '::get();
            return DataTables()->of($data)
            ->addIndexColumn()
            ->editColumn("created_at", function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(["created_at"])
            ->make(true);
    }
        public function changeStatus(' . $model . ' $' . strtolower($model) . ')
        {
            $status = ! $' . strtolower($model) . ' ->status ;
            $' . strtolower($model) . '->update([
                "status" => $status
            ]);
            flash()->addSuccess(trans("user.status_updated_successfully"));
            return redirect()->back();
        }

        }';
}

function WebControllerFile($model, $namespace)
{
    return
        $fileContents = '
        <?php
        namespace App\Http\Controllers\\' . $namespace . ';
        use App\Http\Controllers\Controller;
        use App\Models\\' . $model . ' ;
        use App\Http\Requests\Web\\' . $model . 'Request;
        use App\Http\Repositories\Web\\' . $model . 'Repository;

        class ' . $model . 'Controller extends Controller{
        public function __construct(private $repository = new ' . $model . 'Repository()){}

        public function index()
        {
        return $this->repository->index();
        }
        public function create()
        {
            return $this->repository->create();
        }
        public function store(' . $model . 'Request $request)
        {
            return $this->repository->store($request);
        }
        public function show(' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->show( $' . strtolower($model) . ');
        }
        public function edit(' . $model . 'Request $request, ' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->edit( $' .   strtolower($model) . ');
        }
        public function update(' . $model . 'Request $request, ' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->update($request, $' .   strtolower($model) . ');
        }

        public function destroy(' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->destroy( $' .  strtolower($model) . ');
        }

    }
        ';
}

function ApiRepositoryFile($model, $namespace)
{
    return
        $fileContents = '
    <?php

    namespace App\\Http\\Repositories\\Api;
    use App\\Models\\' . $model . ';
    use App\Http\Requests\Api\\' . $model . 'Request;

    class ' . $model . 'Repository {
                    public function index()
                    {
                        //
                    }

                    public function store(' . $model . 'Request $request)
                    {
                        //
                    }

                    public function show(' . $model . ' $' . $model . ')
                    {
                        //
                    }

                    public function update(' . $model . 'Request $request, ' . $model . ' $' . $model . ')
                    {
                        //
                    }

                    public function destroy(' . $model . ' $' . $model . ')
                    {
                        $' . $model . '->delete();
                        return response()->json();
                    }

    }';
}

function ApiControllerFile($model, $namespace)
{
    return
        $fileContents = '
        <?php
        namespace App\Http\Controllers\Api;
        use App\Http\Controllers\Controller;
        use App\Models\\' . $model . ' ;
        use App\Http\Requests\Api\\' . $model . 'Request;
        use App\Http\Repositories\Api\\' . $model . 'Repository;

        class ' . $model . 'Controller extends Controller{
        public function __construct(private $repository = new ' . $model . 'Repository()){}

        public function index()
        {
        return $this->repository->index();
        }

        public function store(' . $model . 'Request $request)
        {
            return $this->repository->store($request);
        }

        public function show(' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->show( $' . strtolower($model) . ');
        }

        public function update(' . $model . 'Request $request, ' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->show($request, $' .   strtolower($model) . ');
        }

        public function destroy(' . $model . ' $' . strtolower($model) . ')
        {
            return $this->repository->destroy( $' .  strtolower($model) . ');
        }
    }
        ';
}
function checkDirs(array $dirs)
{
    foreach ($dirs as $dir) {
        if (!File::exists($dir)) mkdir($dir, 7777, true);
    }
}
