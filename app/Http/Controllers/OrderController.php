<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showCartPage()
    {
        return response()->view('parts.cart-page');
    }

    public function showCheckoutPage()
    {
        return response()->view('parts.checkout-page');
    }

    public function showUserOrderPage()
    {
        return response()->view('parts.user-order-page');
    }

    public function showUserOrderDetailPage($orderId)
    {
        return response()->view('parts.user-order-detail-page', [
            'orderId' => $orderId
        ]);
    }

    public function showOrderSuccessPage($invoiceId)
    {
        return $this->routeDestination($invoiceId, 'parts.order-success-page');
    }

    public function showOrderCanceledPage($invoiceId)
    {
        return $this->routeDestination($invoiceId, 'parts.order-canceled-page');
    }
    
    public function routeDestination($invoiceId, $destination){
        if (isset($invoiceId)) {
            return view($destination, [
                'invoiceId' => $invoiceId
            ]);
        }
        return redirect()->route('home');
    }
}
