<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function __invoke(UpdateProfileRequest $r)
    {
        $user = User::firstWhere('id', auth()->user()->id);
        $user->update($r->updateAllWithHashedPassword());
        if ($r->image != null) {
            $user->clearMediaCollection('personal_image');
            $user->addMedia($r->image)->toMediaCollection('personal_image');
        }
        return  response()->json(['message' => 'success', 'data' => [
            'user_data' => new UserResource($user->load(['subscription', 'units', 'provider']))
        ]], 200);
    }
}
