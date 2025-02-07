<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductsPage(){
        return response()->view('parts.products-page');
    
    }
    public function showProductDetailPage($product){
        return response()->view('parts.product-detail-page', [
            'product' => $product
        ]);
    }
}
