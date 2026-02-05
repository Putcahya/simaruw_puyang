<?php

namespace App\Http\Controllers;
use App\Models\House;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request) {
    $q = $request->q;

        $houses = House::when($q, function($query) use ($q){
            $query->where('kk_name','like','%'.$q.'%')
                  ->orWhere('house_number','like','%'.$q.'%');
        })->get();

        return view('public.index', compact('houses','q'));
    }

    // Live search API endpoint
    public function liveSearch(Request $request) {
        $q = $request->input('q', '');
        
        if (strlen($q) < 1) {
            return response()->json([
                'houses' => [],
                'count' => 0
            ]);
        }

        $houses = House::where('kk_name','like','%'.$q.'%')
                      ->orWhere('house_number','like','%'.$q.'%')
                      ->limit(10)
                      ->get();

        return response()->json([
            'houses' => $houses,
            'count' => count($houses)
        ]);
    }
}
