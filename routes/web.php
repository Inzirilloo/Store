<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;

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
//devo proteggere sta minchia di rotta
//sto middleware checckerà se ce un aunthenticated user cioe che ha
//un id autenticato dal metodo login che ti redirecta qua
// quando hai fatto auth()->
/*
Route::middleware('auth:sanctum')->get('/product/{product}', function (product $product) {
    // se il gate non allows lo user to vedere il product cioè gli id non mathchano faccciamo qualcosa
    /*if (!Gate::allows('view-product', $product)) {
        abort(403);
    }
    */
/*
    Gate::authorize('edit-product', $product);
})->name('edit');
*/
/*
Route::middleware('auth:sanctum')->delete('/product/{product}', function (product $product) {
    // se il gate non allows lo user to vedere il product cioè gli id non mathchano faccciamo qualcosa
    /*if (!Gate::allows('view-product', $product)) {
        abort(403);
    }
    
    Gate::authorize('destory-product', $product);
    return [ProductController::class, 'destroy'];
})->name('destroy');

*/

Route::middleware(['auth:sanctum'])->group(function () {
});
//Route::get('/product/{product}', [ProductController::class, 'edit'])->name('edit');

Route::group(['middleware' => 'auth'], function () {
    //Gate::authorize('view', $product);
    Route::get('/list', [ProductController::class, 'list'])->name('list');

    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/create', [ProductController::class, 'store'])->name('store');
    // {product} in realtà ovviamente tu gli stai passando l'id del product
    // ma è laravel che nel controller farà automaticamente la query
    Route::get('/product/{product}', [ProductController::class, 'edit'])->name('edit');

    Route::post('/product/{product}', [ProductController::class, 'update'])->name('update');

    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('destroy');

    Route::get('/admin', [AuthController::class, 'admin_index'])->name('admin.index');
    /*
    Route::get('/list', [ProductController::class, 'list'])->name('list');

    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/create', [ProductController::class, 'store'])->name('store');
    // {product} in realtà ovviamente tu gli stai passando l'id del product
    // ma è laravel che nel controller farà automaticamente la query
    Route::get('/product/{product}', [ProductController::class, 'edit'])->name('edit');

    Route::post('/product/{product}', [ProductController::class, 'update'])->name('update');

    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('destroy');
    */
});

Route::get('/dashboard', DashboardController::class)->middleware('auth');
Route::get('/', [AuthController::class, 'show'])->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');


//Route::view('/perche', 'welcome');
//Route::redirect('ciao', 'riciao');
//Route::get('/ciao', [AuthController::class, 'show']);

/*
se vuoi passare un parametro specifico ma non obbligatoriamente
Route::get('/user/{name?}', function (?string $name = null) {
    return $name;
});
 
Route::get('/user/{name?}', function (?string $name = 'John') {
    return $name;
});

*/
