<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Collection;

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

    public static function getByCollection($collection){
        $arr = Collection::where('name', $collection)->first();
        if($arr != null){
            return $arr->products;
        } else {
            return [];
        }
    }

    public static function add(){
        
    }
}
