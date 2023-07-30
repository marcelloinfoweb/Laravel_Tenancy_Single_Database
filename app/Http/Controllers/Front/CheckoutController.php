<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout($subdomain, CartService $cartService)
    {
        if (! $cartService->all()) {
            abort(500);
        }

        return view('front.checkout');
    }

    public function process(
        $subdomain, CartService $cartService, Request $request, Order $order
    ) {
        if (! $cartService->all()) {
            abort(500);
        }

        $order->create([
            'user_id' => auth()->id(),
            'store_id' => Store::whereSubdomain($subdomain)->first()->id,
            'shipping_value' => session('shipping_value'),
            'items' => $cartService->all(),
            'code' => Str::uuid(),
        ]);

        $cartService->clear();

        return redirect()->route('checkout.thanks', $subdomain);
    }

    public function thanks($subdomain)
    {
        return view('front.thanks');
    }
}
