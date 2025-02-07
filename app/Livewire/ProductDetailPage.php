<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $product;
    public $stock;
    public $quantity = 1;

    public function mount($slug){
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->stock = $this->product->stock - 1;
    }

    public function increaseQuantity(){
        if($this->quantity <= $this->product->stock){
            if($this->quantity !== $this->product->stock){
                $this->quantity++;
                --$this->stock;
            }
        }
    }

    public function decreaseQuantity(){
        if($this->quantity > 1){
            $this->quantity--;
            ++$this->stock;
        }
    }

    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);
        if($total_count === -1){
            $this->alert('error', 'You have already added maximum quantity of the product to the cart. Try other products!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true
            ]);
            return;
        }

        // kirim event ke komponen navbar ketika penggna klik tombol Add to Cart
        if($total_count >= 0){
            $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        }

        $this->alert('success', 'Product added to the cart', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true
        ]);
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}
