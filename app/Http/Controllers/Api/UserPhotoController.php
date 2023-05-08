<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserPhotoController extends Controller
{
    public function index(Request $request, string $username)
    {
        $user = User::where("username", $username)->firstOrFail();

        if(Storage::exists("user_photo/{$user->username}"))
        {
            return Storage::response("user_photo/{$user->username}");
        }

        return response()->noContent();
    }

    public function update(UpdateUserPhotoRequest $request)
    {
        $request->update();

        return response()->noContent();
    }
}
