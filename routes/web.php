<?php

use App\Http\Controllers\Backend\Feature\OrderController;
use App\Http\Controllers\Backend\Master\CategoryController;
use App\Http\Controllers\Backend\Master\ProductController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\TransacationController;
use App\Http\Controllers\Midtrans\MidtransController;
use App\Http\Controllers\Rajaongkir\RajaongkirController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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

Route::post('payments/midtrans-notification', [MidtransController::class, 'receive']);



Route::prefix('app')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', function () {
            return view('backend.dashboard');
        })->name('admin.dashboard');

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
        });

        Route::prefix('master')->name('master.')->group(function(){
            
            Route::prefix('category')->name('category.')->group(function(){
                Route::get('/',[CategoryController::class,'index'])->name('index');
                Route::get('/create',[CategoryController::class,'create'])->name('create');
                Route::post('/create',[CategoryController::class,'store'])->name('store');
                Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('delete');
            });

            Route::prefix('product')->name('product.')->group(function(){
                Route::get('/',[ProductController::class,'index'])->name('index');
                Route::get('/create',[ProductController::class,'create'])->name('create');
                Route::post('/create',[ProductController::class,'store'])->name('store');
            });

        });

        Route::prefix('feature')->name('feature.')->group(function(){

            Route::prefix('order')->name('order.')->group(function(){
                Route::get('/{status?}',[OrderController::class,'index'])->name('index');
            });

        });

    });

});

Route::middleware('auth','role:user')->group(function(){

    Route::prefix('cart')->name('cart.')->group(function(){
        Route::get('/',[CartController::class,'index'])->name('index');
        Route::post('/store',[CartController::class,'store'])->name('store');
        Route::get('/delete/{id}',[CartController::class,'delete'])->name('delete');
    });

    Route::prefix('transaction')->name('transaction.')->group(function(){
        Route::get('/',[TransacationController::class,'index'])->name('index');
        Route::get('/{invoice_number}',[TransacationController::class,'show'])->name('show');
    });

    Route::prefix('checkout')->name('checkout.')->group(function(){
        Route::get('/',[CheckoutController::class,'index'])->name('index');
        Route::post('/process',[CheckoutController::class,'process'])->name('process');
    });

    Route::prefix('account')->name('account.')->group(function(){
        Route::get('/',[AccountController::class,'index'])->name('index');
    });


});

Route::prefix('rajaongkir')->name('rajaongkir.')->group(function(){
    Route::post('/cost',[RajaongkirController::class,'cost'])->name('cost');
    Route::get('/province/{id}',[RajaongkirController::class,'getCity'])->name('city');
});


Route::get('/', [HomeController::class,'index'])->name('home');
// Route Product
Route::get('/product', [FrontendProductController::class,'index'])->name('product.index');



// Ruote Category
Route::get('/category', [FrontendCategoryController::class,'index'])->name('category.index');
Route::get('/category/{slug}', [FrontendCategoryController::class,'show'])->name('category.show');



Route::get('/product/{categoriSlug}/{productSlug}',[FrontendProductController::class,'show'])->name('product.show');


require __DIR__ . '/auth.php';
