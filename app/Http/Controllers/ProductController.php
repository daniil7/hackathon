<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
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
}
