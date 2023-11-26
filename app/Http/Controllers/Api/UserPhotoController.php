<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserPhotoController extends Controller
{
    public function index(Request $request, string $username, string $key)
    {
        $user = User::where("username", $username)->firstOrFail();

        if ($user->photo == $key) {
            return Storage::response("user_photo/{$user->photo}");
        }

        return response()->redirectTo("img/user.png");
    }

    public function update(UpdateUserPhotoRequest $request)
    {
        $request->update($request->user());

        return new UserResource($request->user());
    }
}
