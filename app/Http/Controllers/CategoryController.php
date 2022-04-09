<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public static function add(Request $request){
        $this->validate(request(),[
               'name' => ['required']
        ]);
        $name = $request->input('name');
        $category = new Category;
        $category->name = $name;
        $category->save();
    }
}
