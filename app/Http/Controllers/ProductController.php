<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Collection;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function getAll(){
        return Product::All();
    }

    public static function getByCategory($category){
        $collection = Category::where('name', $category)->first();
        if($collection != null){
            return $collection->products;
        } else {
            return [];
        }
    }

    public static function getByCollection($collection){
        $arr = Collection::where('name', $collection)->first();
        if($arr != null){
            return $arr->products;
        } else {
            return [];
        }
    }

    public function add(Request $request, $product = null){

        //
        // Валидация данных

        $request->validate([
               'name' => ['required'],
               'price' => ['required', 'numeric'],
               'category_id' => ['required', 'numeric']
        ]);

        if(Category::find($request->input('category_id')) == null) {
            return redirect()->back()->withErrors(['msg' => 'неверный id']);
        }

        if($product == null) {
            $mimes = array('jpeg','png','jpg','svg');
            $request->validate([
                   'image' => ['required','image','mimes:'.implode(',', $mimes),'max:2048']
            ]);
        }

        if($request->file('image') != null) {
            //
            // Сохраняем файл
            $file = $request->file('image');
            if( !in_array($file->getClientOriginalExtension(), $mimes)) {
                return redirect()->back()->withErrors(['msg' => 'Неправильное расширение файла', 'img' => True]);
            }
            $destinationPath = storage_path('laravel');
            $new_filename = $this->getRandomString(30).".".$file->getClientOriginalExtension();
            $file->move($destinationPath,$new_filename);
        }

        if($product == null){
            $product = new Product;
        }
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description') != null ? $request->input('description') : "";
        $product->collection_id = $request->input('collection_id') != "" ? $request->input('collection_id') : null;
        $product->category_id = $request->input('category_id');
        if($request->file('image') != null){
            $product->image = $new_filename;
        }
        $product->save();

        return redirect()->back();
    }

    public function edit(Request $request){

        $id = $request->input('id');
        $item = Product::findOrFail($id);
        ProductController::add($request, $item);

        return redirect()->back();
    }

    public function remove($id) {

        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }

    public function buy(Request $request){
        $request->validate([
               'product_id' => ['required', 'numeric'],
               'size' => ['required'],
               'amount' => ['required', 'numeric']
        ]);

        $user = Auth::user();
        $cart = new Cart;
        $item = Product::findOrFail($request->input('product_id'))->items->where('size', $request->input('size'))->first();

        // if($item == null) {
        //     return redirect()->back();
        // }
        $cart->item_id = $item->id;
        $cart->amount = $request->input('amount');

        $user->cart_items()->save($cart);

        return redirect()->back();
    }
}
