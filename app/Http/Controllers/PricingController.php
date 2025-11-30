<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display the pricing page.
     */
    public function index()
    {
        $plans = Plan::all();
        
        return view('pricing', compact('plans'));
    }
}
