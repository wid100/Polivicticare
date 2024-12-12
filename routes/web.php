<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PourashavaController;
use App\Http\Controllers\Admin\WardController;
use App\Http\Controllers\Admin\UpazillaController;
use App\Http\Controllers\Auth\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/clear-cache', function () {
    // Clear route cache
    Artisan::call('route:clear');

    // Optimize class loading
    Artisan::call('optimize');

    // Optimize configuration loading
    Artisan::call('config:cache');

    // Optimize views loading
    Artisan::call('view:cache');

    // Additional optimizations you may want to run

    return "Cache cleared and optimizations done successfully.";
});


Route::get('/verify-email/{id}/{hash}', [App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->name('verification.send');




Route::get('verify-email/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = \App\Models\User::findOrFail($id);

    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        throw new \Illuminate\Auth\Access\AuthorizationException;
    }

    if ($user->hasVerifiedEmail()) {
        return redirect(config('app.frontend_url') . '/email-already-verified');
    }

    if ($user->markEmailAsVerified()) {
        event(new \Illuminate\Auth\Events\Verified($user));
    }

    return redirect(config('app.frontend_url') . '/email-verified');
})->name('verification.verify');




Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::namespace('App\Http\Controllers')->group(
    function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

            Route::resource('/users', 'UserController');
            Route::get('/all-doner', 'UserController@DonerIndex')->name('doner.index');
            Route::get('/block', 'UserController@block')->name('block');

            Route::resource('/categorys', 'CategoryController');
            Route::resource('/organization', 'OrganizationController');
            Route::resource('/foundcategory', 'FoundCategoryController');
            Route::resource('/foundrequest', 'FoundRequestController');
            Route::resource('/pourashava', 'PourashavaController');
            Route::resource('/ward', 'WardController');
            Route::resource('/upazilla', 'UpazillaController');

            Route::get('/login/google', [GoogleController::class, 'redirectToGoogle']);
            Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
        });
    }
);
