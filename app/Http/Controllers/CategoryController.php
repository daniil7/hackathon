<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function add(Request $request) {
        $request->validate([
               'name' => 'required'
        ]);
        $name = $request->input('name');
        $category = new Category;
        $category->name = $name;
        $category->save();

        return redirect()->back();
    }
}
