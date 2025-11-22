<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Services\ShopifyPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopifyWebhookController extends Controller
{
    protected $shopifyService;

    public function __construct(ShopifyPaymentService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function handle(Request $request)
    {
        $data = $request->getContent();
        $hmacHeader = $request->header('X-Shopify-Hmac-Sha256');

        if (!$this->shopifyService->verifyWebhook($data, $hmacHeader)) {
            Log::warning('Invalid Shopify webhook signature', [
                'hmac_header' => $hmacHeader,
                'data_length' => strlen($data),
                'data_preview' => substr($data, 0, 200)
            ]);
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $webhookData = json_decode($data, true);

        if ($request->header('X-Shopify-Topic') === 'orders/paid') {
            $this->handleOrderPaid($webhookData);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleOrderPaid(array $orderData)
    {
        $userUuid = null;
        
        if (isset($orderData['note_attributes'])) {
            foreach ($orderData['note_attributes'] as $attribute) {
                if ($attribute['name'] === 'user_uuid') {
                    $userUuid = $attribute['value'];
                    break;
                }
            }
        }

        if (!$userUuid) {
            Log::error('User UUID not found in order', ['order_id' => $orderData['id']]);
            return;
        }

        $user = User::where('uuid', $userUuid)->first();
        if (!$user) {
            Log::error('User not found', ['uuid' => $userUuid]);
            return;
        }

        $premiumPlan = Plan::where('name', 'premium')->first();
        if (!$premiumPlan) {
            Log::error('Premium plan not found');
            return;
        }

        $user->update(['plan_id' => $premiumPlan->id]);
        Log::info('User upgraded to premium', ['user_id' => $user->id]);
    }
}
