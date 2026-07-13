<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;

Route::view('/', 'index');

Route::view('/standard-room','standard-room');
Route::view('/deluxe-room','deluxe-room');
Route::view('/suite-room','suite-room');

Route::post('/reservation',[ReservationController::class,'store'])
    ->name('reservation.store');

Route::post('/contact',[ContactController::class,'store'])
    ->name('contact.store');

Route::post('/standard-room',[ReservationController::class,'standard'])
    ->name('standard.room');

Route::post('/deluxe-room',[ReservationController::class,'deluxe'])
    ->name('deluxe.room');

Route::post('/suite-room',[ReservationController::class,'suite'])
    ->name('suite.room');

    Route::get('/payment/{id}',
    [ReservationController::class,'payment'])
    ->name('payment');

Route::post('/payment/{id}',
    [ReservationController::class,'processPayment'])
    ->name('payment.process');

Route::middleware(['auth'])->group(function(){

    Route::get('/admin',[AdminController::class,'index'])
        ->name('admin');

    Route::delete('/reservation/{id}',
        [AdminController::class,'destroyReservation'])
        ->name('reservation.delete');

    Route::delete('/contact/{id}',
        [AdminController::class,'destroyContact'])
        ->name('contact.delete');
    
        Route::put('/reservation/status/{id}',
    [AdminController::class,'updateStatus'])
    ->name('reservation.status');

    Route::put('/reservation/{id}/verify-payment',
    [AdminController::class,'verifyPayment'])
    ->name('payment.verify');

    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])
    ->name('invoice');

});

require __DIR__.'/auth.php';