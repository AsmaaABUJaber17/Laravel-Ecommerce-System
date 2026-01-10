<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);

Route::resource('orders', OrderController::class)
    ->only(['index', 'show', 'store']);

Route::get('purchase/{product}', [OrderController::class, 'create'])
    ->name('orders.create');

Route::get('/reports', function () {
    return view('reports.index');
});

Route::get('/reports/raw', [ReportController::class, 'rawQueries']);
Route::get('/reports/builder', [ReportController::class, 'builderQueries']);