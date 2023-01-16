<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PackageResource;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ShowPackageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Subscription $subscription)
    {
        return new PackageResource($subscription);
    }
}
