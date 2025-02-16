<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class UserOrderDetailPage extends Component
{
    public $orderId;
    public $order_items;
    public $address;
    public $order;

    public function mount($orderId): void{
        $this->orderId = $orderId;
        $this->order_items = OrderItem::with('product')->where('order_id', $this->orderId)->get();
        $this->address = Address::where('order_id', $this->orderId)->first();
        $this->order = Order::find($this->orderId); 
    }

    public function downloadPdf(){
        $pdf = Pdf::loadHTML(view("parts.pdf.user-order-pdf-page", [
            'order_items' => $this->order_items,
            'address' => $this->address,
            'order' => $this->order,  
        ]))->setPaper('a4', 'portrait');
      
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, 'Invoice-'. $this->order->id . '-' . auth()->user()->name . '.pdf');    
    }

    public function render()
    {
        return view('livewire.user-order-detail-page', [
            'order_items' => $this->order_items,
            'address' => $this->address,
            'order' => $this->order,
        ]);
    }
}
