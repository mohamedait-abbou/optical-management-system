<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReservationController;
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
use App\Http\Controllers\PrescriptionHistoryController;
use App\Http\Controllers\PurchaseOrderController; // ✅ AJOUTEZ CETTE LIGNE
use App\Http\Controllers\SupplierController; // ✅ AJOUTEZ CETTE LIGNE

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
     // Routes pour le calendrier des réservations
    Route::get('/reservations/calendar', [ReservationController::class, 'calendar'])->name('reservations.calendar');
    Route::get('/reservations/events', [ReservationController::class, 'events'])->name('reservations.events');


                    // Notification Routes
        Route::get('/notifications/list', [App\Http\Controllers\NotificationController::class, 'list'])->name('notifications.list');
        Route::post('/notifications/read/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');


                        Route::resource('suppliers', SupplierController::class);
            Route::resource('purchase-orders', PurchaseOrderController::class);
            Route::post('/purchase-orders/{purchaseOrder}/receive', [PurchaseOrderController::class, 'receive'])->name('purchase-orders.receive');



        // Prescription History
        Route::get('/customers/{customer}/prescription-history', [PrescriptionHistoryController::class, 'index'])
            ->name('prescription-history.index');
        Route::get('/customers/{customer}/prescription-history/create', [PrescriptionHistoryController::class, 'create'])
            ->name('prescription-history.create');
        Route::post('/customers/{customer}/prescription-history', [PrescriptionHistoryController::class, 'store'])
            ->name('prescription-history.store');
        Route::get('/customers/{customer}/prescription-history/{prescription}/edit', [PrescriptionHistoryController::class, 'edit'])
            ->name('prescription-history.edit');
        Route::put('/customers/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'update'])
            ->name('prescription-history.update');
        Route::delete('/customers/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'destroy'])
            ->name('prescription-history.destroy');
        Route::get('/customers/{customer}/prescription-history/api/evolution', [PrescriptionHistoryController::class, 'getEvolution'])
            ->name('prescription-history.api.evolution');

    // ==========================================================
    // NIVEAU 1 : TOUT LE MONDE (Admin, Manager, Employé)
    // ==========================================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('stock-movements', StockMovementController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);

    // Factures : Création, Consultation et PDF autorisés pour tous
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
    Route::post('/orders/{order}/invoice', [InvoiceController::class, 'store'])->name('invoices.store');

    // Paiements
    Route::post('/orders/{order}/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::delete('/orders/{order}/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    // Calendrier Réservations
    Route::get('/reservations/calendar', [ReservationController::class, 'calendar'])->name('reservations.calendar');
    Route::get('/reservations/events', [ReservationController::class, 'events'])->name('reservations.events');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // ==========================================================
    // NIVEAU 2 : ADMIN ET MANAGER SEULEMENT
    // ==========================================================
    Route::middleware('role:Admin|Manager')->group(function () {
        // Suppression de facture (Interdit aux employés)
        Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        
        // Ajoutez ici les futures routes "Manager" (ex: Rapports)
    });


    // ==========================================================
    // NIVEAU 3 : ADMIN SEULEMENT
    // ==========================================================
    Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
        
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });


       
}); 

require __DIR__.'/auth.php';