<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Product;

// helper ini bertujuan untuk menangani logic dari keranjang barang 
class CartManagement {
    // menambahkan item ke keranjang
    public static function addItemToCart($product_id){
        $cart_items = self::getCartItemsFromDatabase();

        $existing_item = null;

        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null){
            $data = Cart::find($cart_items[$existing_item]['id']);
            $product = Product::find($cart_items[$existing_item]['product_id']);
            if($data->quantity < $product->stock){
                $data->update([
                    'quantity' => $data->quantity + 1,
                    'total_amount' => ($data->quantity + 1) * $data->unit_amount
                ]);
            }else{
                return -1;
            }
        }else{
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images', 'stock']);
            if($product){
                $data = Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $product->stock > 0 ? 1 : 0,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->stock > 0 ? $product->price : 0,
                ]);
                $cart_items[] = $data;
            }
        }

        return count($cart_items);
    }
    
    // menambahkan item ke keranjang dengan kuantitas
    public static function addItemToCartWithQuantity($product_id, $qty = 1){
        $cart_items = self::getCartItemsFromDatabase();

        $existing_item = null;

        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null){
            $data = Cart::find($cart_items[$existing_item]["id"]);
            $product = Product::find($cart_items[$existing_item]['product_id']);
            if(($data->quantity + $qty) <= $product->stock){
                $data->update([
                    'quantity' => $data->quantity + $qty,
                    'total_amount' => $qty * $data->unit_amount
                ]);
            }else{
                $data->update([
                    'quantity' => $product->stock,
                    'total_amount' => $product->stock * $data->unit_amount
                ]);
                return -1;
            }
        }else{
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            if($product){
                $data = Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $product->stock > 0 ? $qty : 0,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->stock > 0 ? $product->price : 0,
                ]);
                $cart_items[] = $data;
            }
        }

        return count($cart_items);
    }

    // hapus item dari keranjang
    public static function removeCartItem($product_id){
        $cart_items = self::getCartItemsFromDatabase();
        
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                unset($cart_items[$key]);
            }
        }
        Cart::where('product_id', $product_id)->where('user_id', auth()->user()->id)->delete();

        return $cart_items;
    }

    // hapus item di keranjang dari database
    public static function clearCartItems(){
        Cart::where('user_id', auth()->user()->id)->delete();
    }

    // dapatkan semua data item di keranjang dari database
    public static function getCartItemsFromDatabase(){
        $items = Cart::where('user_id', auth()->user()->id)->get();
     
        if(!count($items)){        
            return [];
        }

        return $items;
    }

    // menaikkan nilai kuantitas
    public static function incrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromDatabase();

        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $data = Cart::find($cart_items[$key]['id']);
                $product = Product::find($cart_items[$key]['product_id']);
                if($data->quantity < $product->stock){
                    $data->update([
                        'quantity' => $data->quantity + 1,
                        'total_amount' => ($data->quantity + 1) * $data->unit_amount
                    ]);
                    $cart_items[$key]->quantity = $data->quantity;
                    $cart_items[$key]->total_amount = $cart_items[$key]->quantity * $data->unit_amount;
                }
            }
        }        

        return $cart_items;
    }

    // menurunkan nilai kuantitas
    public static function decrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromDatabase();

        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                if($cart_items[$key]['quantity'] > 1){
                    $data = Cart::find($cart_items[$key]["id"]);
                    $data->update([
                        'quantity' => $data->quantity - 1,
                        'total_amount' => ($data->quantity - 1) * $data->unit_amount
                    ]);

                    $cart_items[$key]->quantity--;
                    $cart_items[$key]->total_amount = $cart_items[$key]->quantity * $cart_items[$key]->unit_amount;
                }
            }
        }

        return $cart_items;
    }

    // hitung jumlah total dari barang yang dibeli
    public static function calculateGrandTotal($items){
        $data = is_array($items) ? $items : $items->toArray();
        return array_sum(array_column($data, 'total_amount'));
    }
}