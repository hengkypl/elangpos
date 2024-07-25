<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukhadiahController;
use App\Http\Controllers\CustomerPointController;
use App\Http\Controllers\TidakTerdaftarController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index']);
Route::resource('tidakterdaftar', TidakTerdaftarController::class);

Route::get('/customer-points', [CustomerPointController::class, 'showForm'])->name('customer.points.showForm');
Route::post('/customer-points', [CustomerPointController::class, 'showPoints'])->name('customer.points.show');
Route::get('customer_points/search', [CustomerPointController::class, 'searchMember'])->name('customer_points.searchMember');
Route::post('customer_points/redeem', [CustomerPointController::class, 'redeemPoints'])->name('customer_points.redeemPoints');
Route::get('/customer-points/form', [CustomerPointController::class, 'form'])->name('customer.points.form');

Route::get('customer/search', [CustomerPointController::class, 'searchMember'])->name('customer.search');
Route::post('customer/redeem', [CustomerPointController::class, 'redeemPoints'])->name('customer.redeem');
Route::get('customer/search', [CustomerPointController::class, 'searchMember'])->name('customer_points.search');
Route::post('customer/redeem', [CustomerPointController::class, 'redeemPoints'])->name('customer_points.redeem');

Route::prefix('hadiah')->name('hadiah.')->group(function () {
    Route::post('/', [ProdukhadiahController::class, 'store'])->name('store');
    Route::get('/', [ProdukhadiahController::class, 'index'])->name('index');
    Route::get('/{id}', [ProdukhadiahController::class, 'show'])->name('show');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('hadiah')->name('hadiah.')->group(function () {
        Route::get('/create', [ProdukhadiahController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [ProdukhadiahController::class, 'edit'])->name('edit');
        Route::delete('/{id}', [ProdukhadiahController::class, 'destroy'])->name('destroy');
        Route::put('/{id}', [ProdukhadiahController::class, 'update'])->name('update');
    });

    Route::get('/redeem', [CustomerPointController::class, 'showSearchForm'])->name('redeem.showSearchForm');
    Route::post('/redeem/search', [CustomerPointController::class, 'searchByMemberId'])->name('redeem.searchMember');
    Route::get('/redeem/results', [CustomerPointController::class, 'showResults'])->name('redeem.showResults');
    Route::post('/redeem/redeem', [CustomerPointController::class, 'redeemPoints'])->name('redeem.points');

});
