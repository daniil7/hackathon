<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Item;

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

Route::get('/dashboard/{category?}', function (Request $reqest, $category = null) {
    return view('dashboard', ['category' => $category]);
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
