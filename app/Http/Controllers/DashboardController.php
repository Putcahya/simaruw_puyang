<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   
use App\Models\House;

class DashboardController extends Controller
{
    public function index()
    {
        $houses = House::latest()->get();
        
        // Calculate RT statistics - count kepala keluarga (KK) per RT
        $rtStatistics = House::whereNotNull('rt')
            ->groupBy('rt')
            ->selectRaw('rt, COUNT(*) as total_kk')
            ->get()
            ->keyBy('rt')
            ->map(function($item) {
                return [
                    'total_kk' => $item->total_kk
                ];
            });
        
        return view('houses.home', compact('houses', 'rtStatistics'));
    }
}
