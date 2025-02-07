<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold">Product</th>
                                <th class="text-left font-semibold">Price</th>
                                <th class="text-left font-semibold">Quantity</th>
                                <th class="text-left font-semibold">Total</th>
                                <th class="text-left font-semibold">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart_items as $key => $item)
                            
                                <tr wire:key="{{ $item['product_id'] }}"
                                    class="relative @if ($cart_items[$key]->product->stock == 0) bg-gray-900/30 z-100 @endif">
                                    <td class="py-4">
                                        <a href="{{ route('product-detail', ['product' => $cart_items[$key]->product->slug]) }}"
                                            class="flex items-center">
                                            <img class="h-16 w-16 mr-4" src="{{ url('storage/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}">
                                            <span class="font-semibold">
                                                {{ $item['name'] }}
                                                <br>
                                                <span class="text-sm font-normal">
                                                    Stock: {{ $cart_items[$key]->product->stock }}
                                                </span>
                                            </span>
                                        </a>
                                    </td>

                                    <td class="py-4">Rp. {{ number_format($item['unit_amount'], 0, ',', '.') }}</td>

                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <button wire:click="decreaseQuantity({{ $item['product_id'] }})"
                                                class="border rounded-md py-2 px-4 mr-2">-</button>
                                            <span class="text-center w-8">
                                                @if ($cart_items[$key]->product->stock)
                                                    {{ $item['quantity'] }}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                            <button wire:click="increaseQuantity({{ $item['product_id'] }})"
                                                class="border rounded-md py-2 px-4 ml-2">+</button>
                                        </div>
                                    </td>

                                    <td class="py-4">Rp.
                                        {{ number_format($cart_items[$key]->product->stock > 0 ? $item['total_amount'] : 0, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                            Remove
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500">No
                                        items available in the cart</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp. {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Tax (PPN 12%)</span>
                        <span>Rp. {{ number_format(0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Discount</span>
                        <span>Rp. {{ number_format(0, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">Rp. {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>
                    @if ($cart_items && $grand_total !== 0)
                        <a href="{{ route('checkout') }}"
                            class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
