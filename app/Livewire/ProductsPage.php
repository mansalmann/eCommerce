<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductsPage extends Component
{
    use WithPagination, LivewireAlert;

    // #[Url]

    public $searchByName = '';
    public $selected_categories = [];
    public $featured;
    public $on_sale;
    public $price_range = 500000;
    public $sort = 'latest';

    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);
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
        $products = Product::where('is_active', 1);

        if($this->searchByName){
            $products->where('name', 'like', '%'. $this->searchByName . '%');
        }

        if(!empty($this->selected_categories)){
            $products->whereIn('category_id', $this->selected_categories);
        }

        if($this->featured){
            $products->Where('is_featured', 1);
        }

        if($this->price_range){
            $products->whereBetween('price', [0, $this->price_range]);
        }

        if($this->sort == 'latest'){
            $products->latest();
        }

        if($this->sort == 'price'){
            $products->orderBy('price');
        }

        if($this->sort == 'stock'){
            $products->orderBy('stock', 'desc');
        }

        return view('livewire.products-page', [
            'products' => $products->paginate(6),
            'categories' => Category::where('is_active', 1)->get()
        ]);
    }
}
