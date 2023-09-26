<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongsApiController;
use App\Http\Controllers\SpacesApiController;

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

Route::get('/getusers', [DashboardController::class, 'getAllUsersWithRoles']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/create_song', [SongsApiController::class, 'createSong']);
Route::post('/get_songs', [SongsApiController::class, 'getAllSongs']);
Route::post('/create_space', [SpacesApiController::class, 'createSpace']);
Route::post('/get_spaces', [SpacesApiController::class, 'getAllSpaces']);
