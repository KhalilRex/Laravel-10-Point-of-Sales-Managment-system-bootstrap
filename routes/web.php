<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TenderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::resource('/home', HomeController::class);
Route::resource('/admins', AdminController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/customers', CustomerController::class);
Route::resource('/products', ProductController::class);
Route::resource('/receipts', ReceiptController::class);
Route::resource('/sales', SalesController::class);
Route::resource('/staff', StaffController::class);
Route::resource('/stocks', StockController::class);
Route::resource('/user', UserController::class);
Route::resource('/orders', OrderController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/tender', TenderController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('barcode', [ProductController::class, 'GetProductBarcodes'])->name('products.barcode');

/*Route::get('barcode', function(){

    return $products = Product::select('barcode')->get();

        return view('products.barcode.index');
})->name('products.barcode');*/