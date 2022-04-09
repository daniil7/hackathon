<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function add(Request $reqest) {
        $request->validate([
               'name' => 'required'
        ]);
        
        $name = $request->input('name');
        $collection = new Collection;
        $collection->name = $name;
        $collection->save();
        
        return redirect()->back();
    }
}
