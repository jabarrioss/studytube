@extends('layouts.admin')

@section('title', 'Create Payment Provider')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-providers.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
        ← Back to Payment Providers
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create Payment Provider</h2>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.payment-providers.store') }}">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Provider Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       placeholder="e.g., Shopify Store"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Provider Type -->
            <div class="mb-6">
                <label for="provider_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Provider Type</label>
                <select name="provider_type" id="provider_type" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                        required>
                    <option value="">Select Type</option>
                    <option value="shopify" {{ old('provider_type') == 'shopify' ? 'selected' : '' }}>Shopify</option>
                    <option value="stripe" {{ old('provider_type') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                    <option value="paypal" {{ old('provider_type') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                    <option value="other" {{ old('provider_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('provider_type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Configuration JSON -->
            <div class="mb-6">
                <label for="config" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Configuration (JSON)
                    <span class="text-gray-500 text-xs font-normal">Optional</span>
                </label>
                <textarea name="config" id="config" rows="8" 
                          placeholder='{"api_key": "your-key", "shop_url": "your-shop.myshopify.com"}'
                          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white font-mono text-sm">{{ old('config') }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter valid JSON configuration for this provider</p>
                @error('config')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                </label>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.payment-providers.index') }}" 
                   class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Create Provider
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
