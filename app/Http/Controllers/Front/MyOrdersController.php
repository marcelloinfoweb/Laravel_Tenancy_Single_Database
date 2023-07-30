<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Store;

class MyOrdersController extends Controller
{
    public function index($subdomain)
    {
        $userOrders = Store::whereSubdomain($subdomain)
            ->first()
            ->customers()
            ->find(auth()->id())
            ->orders;

        return view('front.my-orders', compact('userOrders'));
    }
}
