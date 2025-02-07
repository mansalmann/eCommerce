<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\OrderItem;

class UserOrderDetailPage extends Component
{
    public $orderId;

    public function mount($orderId): void{
        $this->orderId = $orderId;
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->orderId)->get();
        $address = Address::where('order_id', $this->orderId)->first();
        $order = Order::find($this->orderId); 
        return view('livewire.user-order-detail-page', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
        ]);
    }
}
