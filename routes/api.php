<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});
// User

Route::post('/users/{id}', [UserController::class, 'update']);
Route::post('/create-profile/{id}', [ProfileController::class, 'create']);


Route::get('/category', [CategoryController::class, 'index']);
Route::get('/organization', [OrganizationController::class, 'index']);
