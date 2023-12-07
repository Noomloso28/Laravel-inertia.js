<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\QuotationController;

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

Route::get('/', [IndexController::class, 'index'])->name('index.homepage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

/** quotations */
Route::resource('quotations', QuotationController::class);
//Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
//Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
//Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');

Route::get('/quotations/download', [QuotationController::class, 'download'])
    ->name('quotations.download');

