<?php

use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\PlaylistTrackController;
use App\Http\Controllers\Api\TrackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(TrackController::class)
    ->middleware("auth:sanctum")
    ->group(function(){
        Route::get("tracks", "index");
        Route::get("tracks/{track}", "show");
        Route::post("tracks", "store");
        Route::delete("tracks/{track}", "destroy");
    });

Route::controller(PlaylistController::class)
    ->middleware("auth:sanctum")
    ->group(function(){
        Route::get("playlists", "index");
        Route::post("playlists", "store");
        Route::delete("playlists/{playlist}", "destroy");
    });

Route::controller(PlaylistTrackController::class)
    ->middleware("auth:sanctum")
    ->group(function(){
        Route::post("playlists/{playlist}/tracks/{track}", "store");
        Route::delete("playlists/{playlist}/tracks/{track}", "destroy");
    });