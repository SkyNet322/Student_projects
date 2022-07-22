<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

    route::get('/logout', function () {
       
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
  
        return('logout');
    });
});
