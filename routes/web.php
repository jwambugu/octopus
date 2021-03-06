<?php

use App\Http\Controllers\{BookingController,
    HomeController,
    PageController,
    PayPalController,
    PropertyController,
    VacationController
};
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

Route::get('/get-referral-code', [HomeController::class, 'getReferralCode'])->name('get-referral-code');

/**
 * Vacation routes
 */
Route::group([
    'prefix' => 'vacations',
    'as' => 'vacations.',
], static function () {
    Route::get('/', [VacationController::class, 'index'])->name('index');

    Route::get('/get-vacations', [VacationController::class, 'getVacations'])->name('fetch-vacations');

    Route::get('/available-types', [VacationController::class, 'getAvailableVacationTypes'])
        ->name('available.types');

    Route::get('/popular', [VacationController::class, 'getPopularVacations'])->name('popular');

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
], static function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');

    Route::get('/get-properties', [PropertyController::class, 'getAvailableProperties'])
        ->name('get-properties');

    Route::get('/{property:slug}', [PropertyController::class, 'show'])->name('show');
});

/**
 * Booking routes
 */
Route::group([
    'prefix' => 'bookings',
    'as' => 'booking.',
], static function () {
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

    Route::post('cancel-booking', [BookingController::class, 'cancelBooking'])
        ->name('book.cancel-booking');

    Route::post('/lipa-na-paypal', [BookingController::class, 'processPaypalPaymentRequest'])
        ->name('lipa-na-paypal');
});

/**
 * Paypal routes
 */
Route::group([
    'prefix' => 'paypal',
    'as' => 'paypal.'
], static function () {
    Route::get('/cancel-url', [PayPalController::class, 'cancelURL'])->name('cancel-url');

    Route::get('/return-url', [PayPalController::class, 'returnURL'])->name('return-url');
});

