<?php

use Illuminate\Support\Facades\Route;
Route::get('/', ['App\\Http\\Controllers\\OrderController', 'index'])->name('welcome');
Route::post('/orders', ['App\\Http\\Controllers\\OrderController', 'store'])->name('orders.store');
Route::get('/admin/orders', ['App\\Http\\Controllers\\OrderController', 'adminIndex'])->name('admin.orders');
Route::patch('/admin/orders/{order}/status', ['App\\Http\\Controllers\\OrderController', 'updateStatus'])->name('admin.orders.updateStatus');
