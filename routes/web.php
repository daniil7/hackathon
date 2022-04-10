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


Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', function (Request $request) {
        return view('dashboard', ['category' => false, 'collection' => false, 'item' => null]);
    })->name('dashboard');

    Route::get('/category/{category}', function (Request $request, $category) {
        return view('dashboard', ['category' => true, 'collection' => false, 'item' => $category]);
    })->name('category');

    Route::get('/collection/{collection}', function (Request $request, $collection) {
        return view('dashboard', ['category' => false, 'collection' => true, 'item' => $collection]);
    })->name('collection');

    Route::get('/users/me', function () {
        $user = Auth::user();
        return view('user', ['user' => $user]);
    });

    Route::get('/users/{id}', function ($id) {
        $user = User::find($id);
        if ($user == null)
            return abort(404);

        return view('user', ['user' => $user]);
    });

    Route::post('/promocode/activate', 'App\Http\Controllers\PromocodeController@activate');
});



Route::group(['middleware' => 'is.admin'], function () {

    Route::get('/tanechka', function() {
        return view('tanechka');
    }) -> name('tanechka');

    Route::post('/tanechka/add_category', 'App\Http\Controllers\CategoryController@add');
    Route::post('/tanechka/add_collection', 'App\Http\Controllers\CollectionController@add');
    Route::post('/tanechka/add_product', 'App\Http\Controllers\ProductController@add');
    Route::post('/tanechka/edit_product', 'App\Http\Controllers\ProductController@edit');
    Route::get('/tanechka/remove_product/{id}', 'App\Http\Controllers\ProductController@remove');
    Route::post('/tanechka/add_item', 'App\Http\Controllers\ItemController@add');
    Route::get('/tanechka/product/{id}', function($id) {
        return view('tanechka_item', ['id' => $id]);
    });

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

    Route::post('/category', 'App\Http\Controllers\CategoryController@add');
    Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update');

    Route::post('/collection', 'App\Http\Controllers\CollectionController@add');
    Route::put('/collection/{id}', 'App\Http\Controllers\CollectionController@update');

    Route::post('/promocode', 'App\Http\Controllers\PromocodeController@add');
});

require __DIR__.'/auth.php';
