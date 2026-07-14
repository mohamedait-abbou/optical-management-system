<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReservationController;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Prescription;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SettingsController;


use App\Http\Controllers\UserController;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockMovementController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// À AJOUTER dans routes/web.php, dans le     Route::middleware('auth')->group(function () { ... });






Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

   Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // --- BLOC PARAMÈTRES CORRIGÉ ---
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    // -------------------------------

    Route::get('/reservations/calendar', [ReservationController::class, 'calendar'])
    ->name('reservations.calendar');

    Route::get('/reservations/events', [ReservationController::class, 'events'])
    ->name('reservations.events');



Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

// Génération de la facture depuis une commande (pas depuis /invoices/create)
Route::post('/orders/{order}/invoice', [InvoiceController::class, 'store'])->name('invoices.store');


    Route::post('/orders/{order}/payments', [PaymentController::class, 'store'])
        ->name('payments.store');

    Route::delete('/orders/{order}/payments/{payment}', [PaymentController::class, 'destroy'])
        ->name('payments.destroy');
        Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

    Route::resource('orders', OrderController::class);

    Route::resource('brands', BrandController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('stock-movements', StockMovementController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

    Route::resource('customers', CustomerController::class);




}); 


require __DIR__.'/auth.php';