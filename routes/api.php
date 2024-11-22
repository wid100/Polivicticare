<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FoundRequestController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiController;
use App\Models\FoundRequest;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return response()->json($request->user());
// });
// User


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user()->load(['category', 'organization']);
    return response()->json($user);
});


Route::post('/users/{id}', [UserController::class, 'update']);
Route::post('/create-profile/{id}', [ProfileController::class, 'create']);


Route::get('/category', [CategoryController::class, 'index']);
Route::get('/organization', [OrganizationController::class, 'index']);

// FoundRequest
Route::post('/found-request/{id}', [FoundRequestController::class, 'store']);
Route::get('/found-category', [ApiController::class, 'index']);
Route::get('/fonds', [FoundRequestController::class, 'index']);
// get single fond
Route::get('/fonds/{id}', [FoundRequestController::class, 'show']);
