<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\UserApiController;
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

Route::post('login', [UserApiController::class, 'login'])
    ->name('api.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('currencies', [CurrencyController::class, 'index'])
        ->name('currencies.index');
});
