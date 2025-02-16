<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSuccessPage extends Component
{
    public $invoiceId;
    public $order;

    public function mount($invoiceId)
    {
        $this->$invoiceId = $invoiceId;
        $this->order = Order::with('address')->where('user_id', auth()->user()->id)->where('invoice_id', $this->invoiceId)->where('payment_status', 'pending')->first();
        if (!$this->order) {
            return redirect()->route('home');
        }
        if($this->order->payment_method === 'online_payment'){
            $this->order->payment_status = 'paid';
            $this->order->status = 'processing';
            $this->order->save();
        }
    }

    public function render()
    {   
        return view('livewire.order-success-page', [
            'order' => $this->order
        ]);
    }
}
