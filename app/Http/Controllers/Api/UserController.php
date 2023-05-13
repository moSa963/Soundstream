<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    public function show(Request $request, string $username)
    {
        $user = User::where("username", $username)->firstOrFail();
        return new UserResource($user);
    }
}
