<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserAlbumController extends Controller
{
    public function index(Request $request, $username) 
    {
        $user = User::where("username", $username)->firstOrFail();
        
        $albums = $user->albums()->simplePaginate($request->query("count", 100))->withQueryString();

        return PlaylistResource::collection($albums);
    }
}
