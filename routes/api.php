<?php

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

Route::get('/contacts', [\App\Http\Controllers\Contact\ApiContactController::class, 'get']);
Route::post('/contacts', [\App\Http\Controllers\Contact\ApiContactController::class, 'create']);
Route::get('/contacts/{id}', [\App\Http\Controllers\Contact\ApiContactController::class, 'find']);
Route::put('/contacts/{id}', [\App\Http\Controllers\Contact\ApiContactController::class, 'update']);
Route::delete('/contacts/{id}', [\App\Http\Controllers\Contact\ApiContactController::class, 'delete']);
