<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'products'=> Product::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //admin routes
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('transactions', TransactionController::class);
    Route::get('/report',[ProductController::class,'reportStock'])->name('product.reportStock');

    //operator routes
    Route::get('/restock',[TransactionController::class,'restock'])->name('transaction.restock');//package and restock
    Route::get('/stockView', [ProductController::class, 'stockView'])->name('products.stockView');//close-stock-view
    Route::post('/closeStock', [ProductController::class, 'closeStock'])->name('products.closeStock');


});

require __DIR__.'/auth.php';
