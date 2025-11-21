<?php

namespace App\Services;

use App\Models\PaymentProvider;

class ShopifyPaymentService
{
    protected $shopifyDomain;
    protected $storefrontAccessToken;

    public function __construct()
    {
        // Get Shopify configuration from PaymentProvider
        $provider = PaymentProvider::where('name', 'shopify')
            ->where('is_active', true)
            ->first();

        if ($provider) {
            $config = $provider->config_json;
            $this->shopifyDomain = $config['domain'] ?? env('SHOPIFY_DOMAIN');
            $this->storefrontAccessToken = $config['storefront_access_token'] ?? env('SHOPIFY_STOREFRONT_TOKEN');
        }
    }

    /**
     * Generate Shopify cart permalink with user UUID
     */
    public function generateCartPermalink(string $userUuid, string $variantId, int $quantity = 1): string
    {
        // Build cart permalink URL with cart attributes
        // Format: https://{shop}.myshopify.com/cart/{variant_id}:{quantity}?attributes[user_uuid]={uuid}
        
        $cartUrl = "https://{$this->shopifyDomain}/cart/{$variantId}:{$quantity}";
        
        // Add user UUID as cart attribute
        $cartUrl .= "?attributes[user_uuid]={$userUuid}";
        
        return $cartUrl;
    }

    /**
     * Verify webhook signature
     */
    public function verifyWebhook(string $data, string $hmacHeader): bool
    {
        $provider = PaymentProvider::where('name', 'shopify')
            ->where('is_active', true)
            ->first();

        if (!$provider) {
            return false;
        }

        $webhookSecret = $provider->config_json['webhook_secret'] ?? env('SHOPIFY_WEBHOOK_SECRET');
        
        $calculatedHmac = base64_encode(hash_hmac('sha256', $data, $webhookSecret, true));
        
        return hash_equals($calculatedHmac, $hmacHeader);
    }
}
