<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalcController;
use App\Http\Controllers\UseDataController;
use App\Http\Controllers\GetController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    route::get('/user', function () {
        return('Ты авторизован');
    });

    // Позже удалить route::get('/sendinfra', [UseDataController::class, 'sendinfra' ]);

    // Позже удалить route::get('/sendlicen', [UseDataController::class, 'sendlicen' ]);

    route::get('/getguid', [UseDataController::class, 'sendguid' ]);

    route::post('/usedata', [UseDataController::class, 'useguid' ]);

    route::post('/getall', [GetController::class, 'get' ]);

    route::get('/calculate', [CalcController::class, 'calculate' ]);

    route::get('/logout', function () {

        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return('logout');
    });


});
