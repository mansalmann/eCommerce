<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrderPage extends Component
{
    use WithPagination;
    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('livewire.user-order-page', [
            'orders' => $orders
        ]);
    }
}
