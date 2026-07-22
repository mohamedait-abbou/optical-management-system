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
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController; // 👈 Make sure this is here!

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard (accessible à tous)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications (accessible à tous)
    Route::get('/notifications/list', [App\Http\Controllers\NotificationController::class, 'list'])->name('notifications.list');
    Route::post('/notifications/read/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

    // Profil utilisateur (accessible à tous)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ========== CUSTOMERS ==========
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index')->middleware('permission:customers.view|role:Admin');
        Route::get('/create', [CustomerController::class, 'create'])->name('create')->middleware('permission:customers.create|role:Admin');
        Route::post('/', [CustomerController::class, 'store'])->name('store')->middleware('permission:customers.create|role:Admin');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show')->middleware('permission:customers.view|role:Admin');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit')->middleware('permission:customers.edit|role:Admin');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update')->middleware('permission:customers.edit|role:Admin');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy')->middleware('permission:customers.delete|role:Admin');
        
        // Prescription History
        Route::get('/{customer}/prescription-history', [PrescriptionHistoryController::class, 'index'])->name('prescription-history.index')->middleware('permission:customers.view|role:Admin');
        Route::get('/customers/{customer}/prescription-history/api/evolution', [PrescriptionHistoryController::class, 'getEvolution'])->name('prescription-history.api.evolution')->middleware('permission:customers.view|role:Admin');
        Route::get('/{customer}/prescription-history/create', [PrescriptionHistoryController::class, 'create'])->name('prescription-history.create')->middleware('permission:customers.edit|role:Admin');
        Route::post('/{customer}/prescription-history', [PrescriptionHistoryController::class, 'store'])->name('prescription-history.store')->middleware('permission:customers.edit|role:Admin');
        Route::get('/{customer}/prescription-history/{prescription}/edit', [PrescriptionHistoryController::class, 'edit'])->name('prescription-history.edit')->middleware('permission:customers.edit|role:Admin');
        Route::put('/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'update'])->name('prescription-history.update')->middleware('permission:customers.edit|role:Admin');
        Route::delete('/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'destroy'])->name('prescription-history.destroy')->middleware('permission:customers.delete|role:Admin');
    });

    // ========== ORDERS ==========
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index')->middleware('permission:orders.view|role:Admin');
        Route::get('/create', [OrderController::class, 'create'])->name('create')->middleware('permission:orders.create|role:Admin');
        Route::post('/', [OrderController::class, 'store'])->name('store')->middleware('permission:orders.create|role:Admin');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show')->middleware('permission:orders.view|role:Admin');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit')->middleware('permission:orders.edit|role:Admin');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update')->middleware('permission:orders.edit|role:Admin');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy')->middleware('permission:orders.delete|role:Admin');
    });

    // ========== PRODUCTS ==========
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index')->middleware('permission:products.view|role:Admin');
        Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('permission:products.create|role:Admin');
        Route::post('/', [ProductController::class, 'store'])->name('store')->middleware('permission:products.create|role:Admin');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show')->middleware('permission:products.view|role:Admin');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit')->middleware('permission:products.edit|role:Admin');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update')->middleware('permission:products.edit|role:Admin');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy')->middleware('permission:products.delete|role:Admin');
    });

    // ========== PRESCRIPTIONS ==========
    Route::prefix('prescriptions')->name('prescriptions.')->group(function () {
        Route::get('/', [PrescriptionController::class, 'index'])->name('index')->middleware('permission:prescriptions.view|role:Admin');
        Route::get('/create', [PrescriptionController::class, 'create'])->name('create')->middleware('permission:prescriptions.create|role:Admin');
        Route::post('/', [PrescriptionController::class, 'store'])->name('store')->middleware('permission:prescriptions.create|role:Admin');
        Route::get('/{prescription}', [PrescriptionController::class, 'show'])->name('show')->middleware('permission:prescriptions.view|role:Admin');
        Route::get('/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('edit')->middleware('permission:prescriptions.edit|role:Admin');
        Route::put('/{prescription}', [PrescriptionController::class, 'update'])->name('update')->middleware('permission:prescriptions.edit|role:Admin');
        Route::delete('/{prescription}', [PrescriptionController::class, 'destroy'])->name('destroy')->middleware('permission:prescriptions.delete|role:Admin');
    });

    // ========== RESERVATIONS ==========
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index')->middleware('permission:reservations.view|role:Admin');
        Route::get('/calendar', [ReservationController::class, 'calendar'])->name('calendar')->middleware('permission:reservations.view|role:Admin');
        Route::get('/events', [ReservationController::class, 'events'])->name('events')->middleware('permission:reservations.view|role:Admin');
        Route::get('/create', [ReservationController::class, 'create'])->name('create')->middleware('permission:reservations.create|role:Admin');
        Route::post('/', [ReservationController::class, 'store'])->name('store')->middleware('permission:reservations.create|role:Admin');
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show')->middleware('permission:reservations.view|role:Admin');
        Route::get('/{reservation}/edit', [ReservationController::class, 'edit'])->name('edit')->middleware('permission:reservations.edit|role:Admin');
        Route::put('/{reservation}', [ReservationController::class, 'update'])->name('update')->middleware('permission:reservations.edit|role:Admin');
        Route::delete('/{reservation}', [ReservationController::class, 'destroy'])->name('destroy')->middleware('permission:reservations.delete|role:Admin');
    });

    // ========== STOCK MOVEMENTS ==========
    Route::prefix('stock-movements')->name('stock-movements.')->group(function () {
        Route::get('/', [StockMovementController::class, 'index'])->name('index')->middleware('permission:stock-movements.view|role:Admin');
        Route::get('/create', [StockMovementController::class, 'create'])->name('create')->middleware('permission:stock-movements.create|role:Admin');
        Route::post('/', [StockMovementController::class, 'store'])->name('store')->middleware('permission:stock-movements.create|role:Admin');
        Route::get('/{stockMovement}', [StockMovementController::class, 'show'])->name('show')->middleware('permission:stock-movements.view|role:Admin');
        Route::get('/{stockMovement}/edit', [StockMovementController::class, 'edit'])->name('edit')->middleware('permission:stock-movements.edit|role:Admin');
        Route::put('/{stockMovement}', [StockMovementController::class, 'update'])->name('update')->middleware('permission:stock-movements.edit|role:Admin');
        Route::delete('/{stockMovement}', [StockMovementController::class, 'destroy'])->name('destroy')->middleware('permission:stock-movements.delete|role:Admin');
    });

    // ========== BRANDS ==========
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index')->middleware('permission:brands.view|role:Admin');
        Route::get('/create', [BrandController::class, 'create'])->name('create')->middleware('permission:brands.create|role:Admin');
        Route::post('/', [BrandController::class, 'store'])->name('store')->middleware('permission:brands.create|role:Admin');
        Route::get('/{brand}', [BrandController::class, 'show'])->name('show')->middleware('permission:brands.view|role:Admin');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit')->middleware('permission:brands.edit|role:Admin');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('update')->middleware('permission:brands.edit|role:Admin');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy')->middleware('permission:brands.delete|role:Admin');
    });

    // ========== CATEGORIES ==========
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index')->middleware('permission:categories.view|role:Admin');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('permission:categories.create|role:Admin');
        Route::post('/', [CategoryController::class, 'store'])->name('store')->middleware('permission:categories.create|role:Admin');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show')->middleware('permission:categories.view|role:Admin');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:categories.edit|role:Admin');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update')->middleware('permission:categories.edit|role:Admin');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:categories.delete|role:Admin');
    });

    // ========== SUPPLIERS ==========
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index')->middleware('permission:suppliers.view|role:Admin');
        Route::get('/create', [SupplierController::class, 'create'])->name('create')->middleware('permission:suppliers.create|role:Admin');
        Route::post('/', [SupplierController::class, 'store'])->name('store')->middleware('permission:suppliers.create|role:Admin');
        Route::get('/{supplier}', [SupplierController::class, 'show'])->name('show')->middleware('permission:suppliers.view|role:Admin');
        Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit')->middleware('permission:suppliers.edit|role:Admin');
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update')->middleware('permission:suppliers.edit|role:Admin');
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('permission:suppliers.delete|role:Admin');
    });

        // Reports & Analytics
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('permission:view-reports|role:Admin');

    // ========== PURCHASE ORDERS ==========
    Route::prefix('purchase-orders')->name('purchase-orders.')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('index')->middleware('permission:purchase-orders.view|role:Admin');
        Route::get('/create', [PurchaseOrderController::class, 'create'])->name('create')->middleware('permission:purchase-orders.create|role:Admin');
        Route::post('/', [PurchaseOrderController::class, 'store'])->name('store')->middleware('permission:purchase-orders.create|role:Admin');
        Route::get('/{purchaseOrder}', [PurchaseOrderController::class, 'show'])->name('show')->middleware('permission:purchase-orders.view|role:Admin');
        Route::get('/{purchaseOrder}/edit', [PurchaseOrderController::class, 'edit'])->name('edit')->middleware('permission:purchase-orders.edit|role:Admin');
        Route::put('/{purchaseOrder}', [PurchaseOrderController::class, 'update'])->name('update')->middleware('permission:purchase-orders.edit|role:Admin');
        Route::post('/{purchaseOrder}/receive', [PurchaseOrderController::class, 'receive'])->name('receive')->middleware('permission:purchase-orders.edit|role:Admin');
        Route::delete('/{purchaseOrder}', [PurchaseOrderController::class, 'destroy'])->name('destroy')->middleware('permission:purchase-orders.delete|role:Admin');
    });

    // ========== INVOICES ==========
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index')->middleware('permission:invoices.view|role:Admin');
        Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show')->middleware('permission:invoices.view|role:Admin');
        Route::get('/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('pdf')->middleware('permission:invoices.view|role:Admin');
        Route::post('/orders/{order}/invoice', [InvoiceController::class, 'store'])->name('store')->middleware('permission:invoices.create|role:Admin');
        Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('destroy')->middleware('permission:invoices.delete|role:Admin');
    });

    // ========== PAYMENTS ==========
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index')->middleware('permission:orders.view|role:Admin');
        Route::post('/orders/{order}/payments', [PaymentController::class, 'store'])->name('store')->middleware('permission:orders.create|role:Admin');
        Route::delete('/orders/{order}/payments/{payment}', [PaymentController::class, 'destroy'])->name('destroy')->middleware('permission:orders.delete|role:Admin');
    });

    // ========== ADMIN ONLY ==========
    Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});

require __DIR__.'/auth.php';