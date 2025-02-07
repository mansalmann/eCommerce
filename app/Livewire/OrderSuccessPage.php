<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSuccessPage extends Component
{
    public function render()
    {
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();
        return view('livewire.order-success-page', [
            'order' => $latest_order
        ]);
    }
}
