<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentProvider;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    /**
     * Display a listing of payment providers
     */
    public function index()
    {
        $providers = PaymentProvider::orderBy('name')->get();
        return view('admin.payment-providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new payment provider
     */
    public function create()
    {
        return view('admin.payment-providers.create');
    }

    /**
     * Store a newly created payment provider in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'provider_type' => 'required|string|max:50',
            'is_active' => 'boolean',
            'config' => 'nullable|json',
        ]);

        PaymentProvider::create($validated);

        return redirect()->route('admin.payment-providers.index')
            ->with('success', 'Payment provider created successfully.');
    }

    /**
     * Show the form for editing the specified payment provider
     */
    public function edit(PaymentProvider $paymentProvider)
    {
        return view('admin.payment-providers.edit', compact('paymentProvider'));
    }

    /**
     * Update the specified payment provider in storage
     */
    public function update(Request $request, PaymentProvider $paymentProvider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'provider_type' => 'required|string|max:50',
            'is_active' => 'boolean',
            'config' => 'nullable|json',
        ]);

        $paymentProvider->update($validated);

        return redirect()->route('admin.payment-providers.index')
            ->with('success', 'Payment provider updated successfully.');
    }

    /**
     * Remove the specified payment provider from storage
     */
    public function destroy(PaymentProvider $paymentProvider)
    {
        $paymentProvider->delete();

        return redirect()->route('admin.payment-providers.index')
            ->with('success', 'Payment provider deleted successfully.');
    }
}
