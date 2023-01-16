<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SubUnitResource;
use App\Models\SubUnit;
use Illuminate\Http\Request;

class SubUnitController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SubUnit $subUnit)
    {
        return new SubUnitResource($subUnit);
    }
}
