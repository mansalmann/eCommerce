<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\CartManagement;

class CartPage extends Component
{
    public $cart_items;
    public $data = [];
    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromDatabase();
        $this->collectTotalAmountEachItemFromCartItems($this->cart_items);
    }

    public function collectTotalAmountEachItemFromCartItems($cart_items)
    {
        foreach ($cart_items as $key => $item) {
            if ($item->product->stock > 0) {
                $this->data[] = ['total_amount' => $cart_items->toArray()[$key]['total_amount']];
            } else {
                $this->data[] = ['total_amount' => 0];
            }
        }

        $this->grand_total = CartManagement::calculateGrandTotal($this->data);
        $this->data = [];
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->collectTotalAmountEachItemFromCartItems($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQuantity($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->collectTotalAmountEachItemFromCartItems($this->cart_items);
    }

    public function decreaseQuantity($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->collectTotalAmountEachItemFromCartItems($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
