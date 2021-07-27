<?php

use App\Http\Controllers\API\MpesaController;
use App\Http\Controllers\API\PropertyController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'payments/callbacks',
    'namespace' => 'API',
], function () {
    Route::post('lnm-callback', [MpesaController::class, 'lipaNaMpesaCallback'])->name('lnm-callback');
});

Route::group([
    'prefix' => 'internal',
    'namespace' => 'API',
], function () {
    Route::get('property/{id}/booked-dates', [PropertyController::class, 'getBookedDates'])
        ->name('property.booked-dates');
});
