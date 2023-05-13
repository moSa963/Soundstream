<?php

use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\LikedTrackController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\PlaylistPhotoController;
use App\Http\Controllers\Api\PlaylistTrackController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StreamTrackController;
use App\Http\Controllers\Api\TrackController;
use App\Http\Controllers\Api\TrackHistoryController;
use App\Http\Controllers\Api\TrackPhotoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPhotoController;
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

Route::controller(UserController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("user", "index");
        Route::get("users/{username}", "show");
    });

Route::controller(RegisterController::class)
    ->group(function () {
        Route::post("register", "register");
        Route::post("login", "login");
        Route::post("logout", "logout")->middleware("auth:sanctum");;
    });

Route::controller(UserPhotoController::class)
    ->group(function () {
        Route::get("account/{username}/profile/photo", "index");
        Route::post("account/profile/photo", "update")->middleware("auth:sanctum");
    });

Route::controller(TrackController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("tracks", "index");
        Route::get("tracks/{track}", "show");
        Route::post("tracks/albums/{playlist}", "store");
        Route::delete("tracks/{track}", "destroy");
    });

Route::controller(PlaylistController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("playlists", "index");
        Route::get("playlists/{playlist}", "show");
        Route::post("playlists", "store");
        Route::post("playlists/{playlist}", "update");
        Route::delete("playlists/{playlist}", "destroy");
    });

Route::controller(PlaylistTrackController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("playlists/{playlist}/tracks", "index");
        Route::post("playlists/{playlist}/tracks/{track}", "store");
        Route::delete("playlists/{playlist}/tracks/{track}", "destroy");
    });

Route::controller(LikedTrackController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("likes", "index");
        Route::post("likes/tracks/{track}", "store");
        Route::delete("likes/tracks/{track}", "destroy");
    });

Route::controller(StreamTrackController::class)
    ->group(function () {
        Route::get("tracks/{track}/stream", "show");
    });

Route::controller(TrackPhotoController::class)
    ->group(function () {
        Route::get("tracks/{track}/photo", "index");
        Route::post("tracks/{track}/photo", "update")->middleware("auth:sanctum");
        Route::delete("tracks/{track}/photo", "destroy")->middleware("auth:sanctum");
    });

Route::controller(PlaylistPhotoController::class)
    ->group(function () {
        Route::get("playlists/{playlist}/photo", "index");
        Route::post("playlists/{playlist}/photo", "update")->middleware("auth:sanctum");
        Route::delete("playlists/{playlist}/photo", "destroy")->middleware("auth:sanctum");
    });

Route::controller(AlbumController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("albums", "index");
        Route::post("albums", "store");
    });

Route::controller(TrackHistoryController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("history/tracks", "index");
        Route::delete("history/tracks/{track}", "destroy");
    });

Route::controller(SearchController::class)
    ->middleware("auth:sanctum")
    ->group(function () {
        Route::get("search/{key}", "index");
    });
