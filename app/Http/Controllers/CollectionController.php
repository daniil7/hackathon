<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function add(Request $request) {
        $request->validate([
               'name' => 'required'
        ]);

        $name = $request->input('name');
        $collection = new Collection;
        $collection->name = $name;
        $collection->save();

        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $request->validate([
               'name' => 'required'
        ]);
        $name = $request->input('name');
        $collection = Collection::find($id);
        $collection->name = $name;
        $collection->save();

        return redirect()->back();
    }
}
