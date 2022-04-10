<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promocode;


class PromocodeController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'name' => 'required',
            'amount' => ['required', 'numeric', 'min:1']
        ]);
        $name = $request->input('name');
        $amount = $request->input('amount');
        $promocode = new Promocode;
        $promocode->name = $name;
        $promocode->amount = $amount;
        $promocode->save();

        return redirect()->back();
    }

    public function activate(Request $request) {
        $request->validate([
               'name' => 'required'
        ]); 
        $name = $request->input('name');
        $promocode = Promocode::where('name', $name)->first();
        Auth::user()->increment('balance', $promocode->amount);
        
        return redirect()->back();
    }

}
