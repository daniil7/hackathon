<?php

use Illuminate\Support\Facades\Route;

use App\Model\Category;
use App\Model\Product;
use App\Model\Item;

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

Route::get('/dashboard', function (Request $request) {
    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => 'is.admin'], function () {
    Route::get('/tanechka/categories', function() {
        return Category::all();
    });

    Route::get('/tanechka/products', function() {
        return Product::all();
    });

    Route::get('/tanechka/items', function() {
        return Item::all();
    });

    Route::get('/tanechka/users', function() {
        return User::all();
    });

});

require __DIR__.'/auth.php';
