<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact-us');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/**
 * Property routes
 */
Route::group([
    'prefix' => 'properties',
    'as' => 'properties.',
], function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::get('/fetch-properties', [PropertyController::class, 'getProperties'])->name('fetch-properties');
    Route::get('/{property:slug}', [PropertyController::class, 'show'])->name('show');
});
