<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('transaction')->group(function () {
        Route::post('store', [TransactionController::class, 'createTransaction'])->name('transaction.create');
        Route::delete('delete', [TransactionController::class, 'deleteTransaction'])->name('transaction.delete');
    });

    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'categoryList'])->name('category.list');
        Route::post('store', [CategoryController::class, 'categoryCreate'])->name('category.create');
        Route::delete('delete', [CategoryController::class, 'categoryDelete'])->name('category.delete');
    });
});
