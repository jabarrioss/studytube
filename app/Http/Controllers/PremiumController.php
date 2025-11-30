<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Redirect to subscription page if already premium
        if ($user->subscribed('default')) {
            return redirect()->route('subscription.index')->with('info', 'You are already a Premium member!');
        }

        return view('premium.index');
    }
}
