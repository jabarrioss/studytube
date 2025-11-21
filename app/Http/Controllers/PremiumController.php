<?php

namespace App\Http\Controllers;

use App\Services\ShopifyPaymentService;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    protected $shopifyService;

    public function __construct(ShopifyPaymentService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->plan && $user->plan->name === 'premium') {
            return redirect()->route('topics.index')->with('info', 'You are already premium!');
        }

        $variantId = env('SHOPIFY_PREMIUM_VARIANT_ID', 'VARIANT_ID');
        $checkoutUrl = $this->shopifyService->generateCartPermalink($user->uuid, $variantId);

        return view('premium.index', compact('checkoutUrl'));
    }
}
