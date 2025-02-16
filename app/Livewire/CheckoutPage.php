<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use Livewire\Component;
use App\Mail\OrderPlaced;
use App\Models\OrderItem;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Xendit\Invoice\InvoiceApi;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Xendit\Invoice\CreateInvoiceRequest;

class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $payment_method;
    public $cart_items;
    public $grand_total;
    public $data = [];
    public $invoiceId;


    public function mount()
    {

        $this->cart_items = CartManagement::getCartItemsFromDatabase();
        $this->invoiceId = "Invoice-" . time() . "-" . (string) Str::uuid();

        // hitung total harga dari seluruh barang yang dipesan
        foreach ($this->cart_items as $key => $item) {
            if ($item->product->stock > 0) {
                $this->data[] = ['total_amount' => $this->cart_items->toArray()[$key]['total_amount']];
            } else {
                $this->data[] = ['total_amount' => 0];
            }
        }
        $this->grand_total = CartManagement::calculateGrandTotal($this->data);
        if (count($this->cart_items) == 0) {
            return redirect()->route('products');
        }
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules()
    {
        $request = new OrderRequest();
        return $request->rules();
    }

    public function validateInput()
    {
        // validasi menggunakan OrderRequest
        $this->validate($this->rules());
        $this->placeOrder();
    }

    public function placeOrder()
    {
        // membuat data baru dari order
        $order = new Order();
        $order->invoice_id = $this->invoiceId;
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($this->data);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->notes = 'Order placed by ' . auth()->user()->name;
        $order->save();

        // mengisi data alamat dari setiap order
        $address = new Address();
        $address->order_id = $order->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->address = $this->address;
        $address->save();

        // membuat data order items yang baru
        $data = [];
        foreach ($this->cart_items as $item) {
            if ($item->product->stock > 0) {
                $data[] = $item->toArray();
            }
        }
        $order->items()->createMany($data);
        $items = OrderItem::with('product')->where('order_id', $order->id)->get(['id', 'product_id', 'quantity'])->toArray();
        foreach ($items as $item) {
            DB::beginTransaction();
            $product = Product::find($item['product_id']);
            // perbarui stok barang yang dibeli berdasarkan product id dari tabel order_items
            if ($product && $product->stock > 0) {
                $product->update([
                    'stock' => $product->stock - $item['quantity']
                ]);
                DB::commit();
            } else {
                DB::rollBack();
            }
        }

        if ($this->payment_method === 'online_payment') {
            Configuration::setXenditKey(env('XENDIT_API_KEY'));
            $apiInstance = new InvoiceApi();
            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $this->invoiceId,
                'amount' => $this->grand_total,
                'invoice_duration' => 86400,
                'currency' => 'IDR',
                'reminder_time' => 1,
                'customer' => [
                    'given_names' => $address->full_name,
                    'mobile_number' => $this->phone
                ],
                "success_redirect_url" => route('order-success', ['invoiceId' => $this->invoiceId]),
                "failure_redirect_url" => route('order-canceled', ['invoiceId' => $this->invoiceId])
            ]);


            try {
                $result = $apiInstance->createInvoice($create_invoice_request);
                $redirect_url = $result['invoice_url'];
            } catch (\Xendit\XenditSdkException $e) {
                dd($e);
                return redirect()->route('order-canceled', ['invoiceId' => $this->invoiceId]);
            }

        } else {
            $redirect_url = route('order-success', ['invoiceId' => $this->invoiceId]); // khusus metode pembayaran Cash on Delivery
        }

        CartManagement::clearCartItems(); // hapus item di keranjang
        Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }

    public function render()
    {
        return view('livewire.checkout-page', [
            'cart_items' => $this->cart_items,
            'grand_total' => $this->grand_total
        ]);
    }
}
