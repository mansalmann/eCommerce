<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        Checkout
    </h1>
    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">

                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <input type="hidden" name="order_id" value="{{ $grand_total }}">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    First Name
                                </label>
                                <input wire:model="first_name"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="first_name" type="text">
                                </input>
                                @error('first_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    Last Name
                                </label>
                                <input wire:model="last_name"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="last_name" type="text">
                                </input>
                                @error('last_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                Phone
                            </label>
                            <input wire:model="phone"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="phone" type="text">
                            </input>
                            @error('phone')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                Address
                            </label>
                            <input wire:model="address"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="address" type="text">
                            </input>
                            @error('address')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-4">
                        Select Payment Method
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        {{-- <li>
                            <input wire:model="payment_method" class="hidden peer" type="radio"
                                value="virtual_transfer" id="virtual_transfer" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="virtual_transfer">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Virtual Transfer
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li> --}}
                        <li>
                            <input wire:model="payment_method" class="hidden peer" type="radio" value="cod"
                                id="cod">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="cod">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Cash on Delivery
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                            </input>
                        </li>
                    </ul>
                    @error('payment_method')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        ORDER SUMMARY
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Subtotal
                        </span>
                        <span>
                            Rp. {{ number_format($grand_total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Tax
                        </span>
                        <span>
                            Rp. {{ number_format(0, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Discount
                        </span>
                        <span>
                            Rp. {{ number_format(0, 0, ',', '.') }}
                        </span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Grand Total
                        </span>
                        <span>
                            Rp. {{ number_format($grand_total, 0, ',', '.') }}
                        </span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                    class="mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600 @if ($grand_total === 0) bg-gray-800 pointer-events-none opacity-50 @else bg-green-500 @endif"
                    wire:loading.class.remove="bg-gray-800 pointer-events-none"
                    @if ($grand_total === 0) disabled @endif>
                    <span wire:loading.class="hidden">
                        Place Order
                    </span>
                    <span wire:loading wire:loading.class.remove="hidden" class="hidden">
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Processing...
                    </span>
                </button>
                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        BASKET SUMMARY
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($cart_items as $item)
                            <li class="py-3 sm:py-4 relative" wire:key="{{ $item['product_id'] }}">
                                @if ($item->product->stock <= 0)
                                    <div class="absolute inset-0 flex items-center justify-center bg-gray-900/30 z-10">
                                        <p class="text-slate-800 dark:text-white font-bold text-lg">Out of Stock!</p>
                                    </div>
                                @endif
                                <div class="flex items-center {{ $item->product->stock <= 0 ? 'opacity-25' : '' }}">
                                    <div class="flex-shrink-0">
                                        <img alt="{{ $item['name'] }}" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage/' . $item['image']) }}">
                                        </img>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Quantity: {{ $item['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        Rp. {{ number_format($item['total_amount'], 0, ',', '.') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
