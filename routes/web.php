<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\VacationController;
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
Route::put('/update-profile', [HomeController::class, 'updateProfile'])->name('update-profile');
Route::get('/change-password', [HomeController::class, 'changePasswordView'])->name('change-password');
Route::put('/change-password', [HomeController::class, 'changePassword'])->name('change-password-request');

/**
 * Vacation routes
 */
Route::group([
    'prefix' => 'vacations',
    'as' => 'vacations.',
], function () {
    Route::get('/', [VacationController::class, 'index'])->name('index');

    Route::get('/fetch-vacations', [VacationController::class, 'getVacations'])->name('fetch-vacations');

    Route::get('/get-available-vacations', [VacationController::class, 'getAvailableVacationTypes'])
        ->name('get-available-vacations');

    Route::get('/{property:slug}', [VacationController::class, 'show'])->name('show');

    Route::get('/{property:slug}/rate-property', [VacationController::class, 'createPropertyBookingRatingView'])
        ->name('rate-property')->middleware('signed');

    Route::post('/rate-property', [VacationController::class, 'createPropertyBookingRating'])
        ->name('submit-rating');
});

/**
 * Property routes
 */
Route::group([
    'prefix' => 'properties',
    'as' => 'properties.',
], function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');

});

/**
 * Booking routes
 */
Route::group([
    'prefix' => 'bookings',
    'as' => 'booking.',
], function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');

    Route::get('/{booking:uuid}', [BookingController::class, 'show'])->name('show');

    Route::get('/{property:slug}/book', [BookingController::class, 'showPropertyBookingView'])
        ->name('property.view');

    Route::post('/book-property', [BookingController::class, 'bookProperty'])->name('book.property');

    Route::get('/{booking:uuid}/lipa-na-mpesa', [BookingController::class, 'renderMpesaPaymentView'])
        ->name('book.lipa-na-mpesa')->middleware('signed');

    Route::post('/lipa-na-mpesa', [BookingController::class, 'processMpesaPaymentRequest'])
        ->name('book.lipa-na-mpesa.push');

    Route::post('{booking:uuid}/confirm-mpesa-payment', [BookingController::class, 'confirmBookingPayment'])
        ->name('book.confirm-mpesa-payment');
});

