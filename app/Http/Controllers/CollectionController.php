<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;

class CollectionController extends Controller
{
    public static function add(Request $reqest){
        $this->validate(request(),[
               'name' => ['required']
        ]);
        $name = $request->input('name');
        $collection = new Collection;
        $collection->name = $name;
        $collection->save();
    }
}
