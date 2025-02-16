<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderCancelPage extends Component
{
    public $invoiceId;
    public $order;

    public function mount($invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->order = Order::where('user_id', auth()->user()->id)->where('invoice_id', $this->invoiceId)->where('payment_status', 'pending')->first();
        if (!$this->order) {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        $this->order->payment_status = 'failed';
        $this->order->status = 'canceled';
        $this->order->save();
        return view('livewire.order-cancel-page');
    }
}
