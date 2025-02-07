<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function showCartPage(){
        return response()->view('parts.cart-page');
    }
    public function showCheckoutPage(){
        return response()->view('parts.checkout-page');
    }
    public function showUserOrderPage(){
        return response()->view('parts.user-order-page');
    }
    public function showUserOrderDetailPage($orderId){
        return response()->view('parts.user-order-detail-page', [
            'orderId' => $orderId
        ]);
    }
    public function showOrderSuccessPage(){
        return response()->view('parts.order-success-page');
    }
    public function showOrderCanceledPage(){
        return response()->view('parts.order-canceled-page');
    }
}
