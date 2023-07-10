<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'createUser'])->name('register');
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('login');

Route::get('logs/count', [LogController::class,'count_logs'])
    ->middleware('auth:sanctum')->name('logCounts');

Route::get('log-to-db', function (){
    Artisan::call('Log:ToDB');
})->name('logToDB');
