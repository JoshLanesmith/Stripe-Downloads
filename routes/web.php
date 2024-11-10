<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testing', function () {
    return view('testing');
});

Route::get('/stripe/customers', [StripeController::class, 'getCustomers']);
Route::get('/stripe/invoices', [StripeController::class, 'getInvoices']);