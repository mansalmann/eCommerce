<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Helpers\CartManagement;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount(){
        if(auth()->user()){
            $this->total_count = count(CartManagement::getCartItemsFromDatabase());
        }
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
