<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Product;

class ItemController extends Controller
{

    public static function getAll($product) {
        $table = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $items = $product->items;
        $res = [];
        foreach ($table as $size) {
            $cur_sz = $items->where('size', $size)->first();
            array_push($res, [$size => $cur_sz != null ? $cur_sz->amount : 0]);
        }
        return $res;
    }

    public static function add(Request $request) {
        $request->validate([
               'product_id' => ['required'],
               'size' => ['required'],
               'amount' => ['required', 'numeric']
        ]);
        $product = Product::findOrFail($request->input('product_id'));

        $item = $product->items->where('size', $request->input('size'))->first();
        if($item == null){
            $item = new Item;
            $item->size = $request->input('size');
            $item->amount = $request->input('amount');
            $product->items()->save($item);
        } else {
            $item->amount = $item->amount + (int)$request->input('amount');
            $item->save();
        }

        return redirect()->back();
    }
}
