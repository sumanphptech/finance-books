<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoAuthController;
use App\Http\Controllers\ZohoController;

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

Route::get('/auth/redirect', [ZohoAuthController::class, 'redirect']);

Route::get('/auth/callback', [ZohoAuthController::class, 'callback']);

Route::get('/chartAccounts', [ZohoController::class,'getChartAccounts']);

Route::get('/contacts', [ZohoController::class,'getContacts']);

Route::get('/receipts', [ZohoController::class,'getReceipts']);
