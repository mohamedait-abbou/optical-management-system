<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PrescriptionHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

 // 👈 Make sure this is here!

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard (accessible à tous)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications (accessible à tous)
    Route::get('/notifications/list', [NotificationController::class, 'list'])->name('notifications.list');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

    // Profil utilisateur (accessible à tous)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ========== CUSTOMERS ==========
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index')->middleware('role_or_permission:customers.view|Admin');
        Route::get('/create', [CustomerController::class, 'create'])->name('create')->middleware('role_or_permission:customers.create|Admin');
        Route::post('/', [CustomerController::class, 'store'])->name('store')->middleware('role_or_permission:customers.create|Admin');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show')->middleware('role_or_permission:customers.view|Admin');
        Route::get('/{customer}/card', [CustomerController::class, 'card'])->name('card')->middleware('role_or_permission:customers.view|Admin');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit')->middleware('role_or_permission:customers.edit|Admin');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update')->middleware('role_or_permission:customers.edit|Admin');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:customers.delete|Admin');
        Route::post('/{customer}/notify-email', [CustomerController::class, 'notifyEmail'])->name('notify-email')->middleware('role_or_permission:customers.edit|Admin');
    });

    // Prescription History (separate group so route names are prescription-history.*, not customers.prescription-history.*)
    Route::prefix('customers')->name('prescription-history.')->group(function () {
        Route::get('/{customer}/prescription-history', [PrescriptionHistoryController::class, 'index'])->name('index')->middleware('role_or_permission:customers.view|Admin');
        Route::get('/customers/{customer}/prescription-history/api/evolution', [PrescriptionHistoryController::class, 'getEvolution'])->name('api.evolution')->middleware('role_or_permission:customers.view|Admin');
        Route::get('/{customer}/prescription-history/create', [PrescriptionHistoryController::class, 'create'])->name('create')->middleware('role_or_permission:customers.edit|Admin');
        Route::post('/{customer}/prescription-history', [PrescriptionHistoryController::class, 'store'])->name('store')->middleware('role_or_permission:customers.edit|Admin');
        Route::get('/{customer}/prescription-history/{prescription}/edit', [PrescriptionHistoryController::class, 'edit'])->name('edit')->middleware('role_or_permission:customers.edit|Admin');
        Route::put('/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'update'])->name('update')->middleware('role_or_permission:customers.edit|Admin');
        Route::delete('/{customer}/prescription-history/{prescription}', [PrescriptionHistoryController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:customers.delete|Admin');
    });

    // ========== ORDERS ==========
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index')->middleware('role_or_permission:orders.view|Admin');
        Route::get('/create', [OrderController::class, 'create'])->name('create')->middleware('role_or_permission:orders.create|Admin');
        Route::post('/', [OrderController::class, 'store'])->name('store')->middleware('role_or_permission:orders.create|Admin');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show')->middleware('role_or_permission:orders.view|Admin');
        Route::get('/{order}/card', [OrderController::class, 'card'])->name('card')->middleware('role_or_permission:orders.view|Admin');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit')->middleware('role_or_permission:orders.edit|Admin');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update')->middleware('role_or_permission:orders.edit|Admin');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:orders.delete|Admin');
    });

    // ========== PRODUCTS ==========
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index')->middleware('role_or_permission:products.view|Admin');
        Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('role_or_permission:products.create|Admin');
        Route::post('/', [ProductController::class, 'store'])->name('store')->middleware('role_or_permission:products.create|Admin');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show')->middleware('role_or_permission:products.view|Admin');
        Route::get('/{product}/card', [ProductController::class, 'card'])->name('card')->middleware('role_or_permission:products.view|Admin');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit')->middleware('role_or_permission:products.edit|Admin');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update')->middleware('role_or_permission:products.edit|Admin');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:products.delete|Admin');
    });

    // ========== PRESCRIPTIONS ==========
    Route::prefix('prescriptions')->name('prescriptions.')->group(function () {
        Route::get('/', [PrescriptionController::class, 'index'])->name('index')->middleware('role_or_permission:prescriptions.view|Admin');
        Route::get('/create', [PrescriptionController::class, 'create'])->name('create')->middleware('role_or_permission:prescriptions.create|Admin');
        Route::post('/', [PrescriptionController::class, 'store'])->name('store')->middleware('role_or_permission:prescriptions.create|Admin');
        Route::get('/{prescription}', [PrescriptionController::class, 'show'])->name('show')->middleware('role_or_permission:prescriptions.view|Admin');
        Route::get('/{prescription}/card', [PrescriptionController::class, 'card'])->name('card')->middleware('role_or_permission:prescriptions.view|Admin');
        Route::get('/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('edit')->middleware('role_or_permission:prescriptions.edit|Admin');
        Route::put('/{prescription}', [PrescriptionController::class, 'update'])->name('update')->middleware('role_or_permission:prescriptions.edit|Admin');
        Route::delete('/{prescription}', [PrescriptionController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:prescriptions.delete|Admin');
    });

    // ========== RESERVATIONS ==========
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index')->middleware('role_or_permission:reservations.view|Admin');
        Route::get('/calendar', [ReservationController::class, 'calendar'])->name('calendar')->middleware('role_or_permission:reservations.view|Admin');
        Route::get('/events', [ReservationController::class, 'events'])->name('events')->middleware('role_or_permission:reservations.view|Admin');
        Route::get('/create', [ReservationController::class, 'create'])->name('create')->middleware('role_or_permission:reservations.create|Admin');
        Route::post('/', [ReservationController::class, 'store'])->name('store')->middleware('role_or_permission:reservations.create|Admin');
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show')->middleware('role_or_permission:reservations.view|Admin');
        Route::get('/{reservation}/card', [ReservationController::class, 'card'])->name('card')->middleware('role_or_permission:reservations.view|Admin');
        Route::get('/{reservation}/edit', [ReservationController::class, 'edit'])->name('edit')->middleware('role_or_permission:reservations.edit|Admin');
        Route::put('/{reservation}', [ReservationController::class, 'update'])->name('update')->middleware('role_or_permission:reservations.edit|Admin');
        Route::delete('/{reservation}', [ReservationController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:reservations.delete|Admin');
    });

    // ========== STOCK MOVEMENTS ==========
    Route::prefix('stock-movements')->name('stock-movements.')->group(function () {
        Route::get('/', [StockMovementController::class, 'index'])->name('index')->middleware('role_or_permission:stock-movements.view|Admin');
        Route::get('/create', [StockMovementController::class, 'create'])->name('create')->middleware('role_or_permission:stock-movements.create|Admin');
        Route::post('/', [StockMovementController::class, 'store'])->name('store')->middleware('role_or_permission:stock-movements.create|Admin');
        Route::get('/{stockMovement}', [StockMovementController::class, 'show'])->name('show')->middleware('role_or_permission:stock-movements.view|Admin');
        Route::get('/{stockMovement}/card', [StockMovementController::class, 'card'])->name('card')->middleware('role_or_permission:stock-movements.view|Admin');
        Route::get('/{stockMovement}/edit', [StockMovementController::class, 'edit'])->name('edit')->middleware('role_or_permission:stock-movements.edit|Admin');
        Route::put('/{stockMovement}', [StockMovementController::class, 'update'])->name('update')->middleware('role_or_permission:stock-movements.edit|Admin');
        Route::delete('/{stockMovement}', [StockMovementController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:stock-movements.delete|Admin');
    });

    // ========== BRANDS ==========
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index')->middleware('role_or_permission:brands.view|Admin');
        Route::get('/create', [BrandController::class, 'create'])->name('create')->middleware('role_or_permission:brands.create|Admin');
        Route::post('/', [BrandController::class, 'store'])->name('store')->middleware('role_or_permission:brands.create|Admin');
        Route::get('/{brand}', [BrandController::class, 'show'])->name('show')->middleware('role_or_permission:brands.view|Admin');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit')->middleware('role_or_permission:brands.edit|Admin');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('update')->middleware('role_or_permission:brands.edit|Admin');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:brands.delete|Admin');
    });

    // ========== CATEGORIES ==========
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index')->middleware('role_or_permission:categories.view|Admin');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('role_or_permission:categories.create|Admin');
        Route::post('/', [CategoryController::class, 'store'])->name('store')->middleware('role_or_permission:categories.create|Admin');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show')->middleware('role_or_permission:categories.view|Admin');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('role_or_permission:categories.edit|Admin');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update')->middleware('role_or_permission:categories.edit|Admin');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:categories.delete|Admin');
    });

    // ========== SUPPLIERS ==========
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index')->middleware('role_or_permission:suppliers.view|Admin');
        Route::get('/create', [SupplierController::class, 'create'])->name('create')->middleware('role_or_permission:suppliers.create|Admin');
        Route::post('/', [SupplierController::class, 'store'])->name('store')->middleware('role_or_permission:suppliers.create|Admin');
        Route::get('/{supplier}', [SupplierController::class, 'show'])->name('show')->middleware('role_or_permission:suppliers.view|Admin');
        Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit')->middleware('role_or_permission:suppliers.edit|Admin');
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update')->middleware('role_or_permission:suppliers.edit|Admin');
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:suppliers.delete|Admin');
    });

    // Reports & Analytics
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('role_or_permission:view-reports|Admin');

    // ========== PURCHASE ORDERS ==========
    Route::prefix('purchase-orders')->name('purchase-orders.')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('index')->middleware('role_or_permission:purchase-orders.view|Admin');
        Route::get('/create', [PurchaseOrderController::class, 'create'])->name('create')->middleware('role_or_permission:purchase-orders.create|Admin');
        Route::post('/', [PurchaseOrderController::class, 'store'])->name('store')->middleware('role_or_permission:purchase-orders.create|Admin');
        Route::get('/{purchaseOrder}', [PurchaseOrderController::class, 'show'])->name('show')->middleware('role_or_permission:purchase-orders.view|Admin');
        Route::get('/{purchaseOrder}/edit', [PurchaseOrderController::class, 'edit'])->name('edit')->middleware('role_or_permission:purchase-orders.edit|Admin');
        Route::put('/{purchaseOrder}', [PurchaseOrderController::class, 'update'])->name('update')->middleware('role_or_permission:purchase-orders.edit|Admin');
        Route::post('/{purchaseOrder}/receive', [PurchaseOrderController::class, 'receive'])->name('receive')->middleware('role_or_permission:purchase-orders.edit|Admin');
        Route::delete('/{purchaseOrder}', [PurchaseOrderController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:purchase-orders.delete|Admin');
    });

    // ========== INVOICES ==========
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index')->middleware('role_or_permission:invoices.view|Admin');
        Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show')->middleware('role_or_permission:invoices.view|Admin');
        Route::get('/{invoice}/card', [InvoiceController::class, 'card'])->name('card')->middleware('role_or_permission:invoices.view|Admin');
        Route::get('/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('pdf')->middleware('role_or_permission:invoices.view|Admin');
        Route::post('/orders/{order}/invoice', [InvoiceController::class, 'store'])->name('store')->middleware('role_or_permission:invoices.create|Admin');
        Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:invoices.delete|Admin');
    });

    // ========== PAYMENTS ==========
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index')->middleware('role_or_permission:orders.view|Admin');
        Route::post('/orders/{order}/payments', [PaymentController::class, 'store'])->name('store')->middleware('role_or_permission:orders.create|Admin');
        Route::delete('/orders/{order}/payments/{payment}', [PaymentController::class, 'destroy'])->name('destroy')->middleware('role_or_permission:orders.delete|Admin');
    });

    // ========== ADMIN ONLY ==========
    Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});

require __DIR__.'/auth.php';
