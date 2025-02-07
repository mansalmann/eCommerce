<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage/' . $product->images[0]) }}' }">
                    <div class="sticky top-0 z-10 overflow-hidden">
                        <div class="relative mb-6 lg:mb-10 lg:h-2/4 ">
                            <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full ">
                        </div>
                        <div class="flex-wrap hidden md:flex">
                            @foreach ($product->images as $image)
                                <div class="w-1/2 p-2 sm:w-1/4" x-on:click="mainImage='{{ url('storage/' . $image) }}'">
                                    <img src="{{ url('storage/' . $image) }}" alt="{{ $product->name }}"
                                        class="object-cover w-full lg:h-20 cursor-pointer hover:border hover:border-blue-500">
                                </div>
                            @endforeach
                        </div>
                        <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400 ">
                            <div class="flex flex-wrap items-center mt-6">
                                <span class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="w-4 h-4 text-gray-700 dark:text-gray-400 bi bi-truck"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                        </path>
                                    </svg>
                                </span>
                                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-400">Free Shipping</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2 ">
                    <div class="lg:pl-20">
                        <div class="mb-8 [&>ul]:list-disc [&>ul]:ml-4">
                            <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{ $product->name }}</h2>
                            <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                                <span>Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                            </p>
                            <div
                                class="prose prose-headings:font-bold prose-headings:text-blue-600 prose-a:text-green-600 prose-strong:text-slate-800 prose-p:text-gray-700 dark:prose-p:text-white">
                                {!! Str::markdown($product->description, [
                                    'html_input' => 'strip',
                                    'allow_unsafe_links' => false,
                                ]) !!}
                            </div>
                        </div>
                        <div class="w-64 mb-8">
                            <label for=""
                                class="w-full pb-1 text-xl font-semibold text-gray-700 border-b border-blue-300 dark:border-gray-600 dark:text-gray-400">Quantity</label>
                            <div class="relative flex flex-row w-64 h-10 mt-6 bg-transparent rounded-lg">
                                <button wire:click="decreaseQuantity"
                                    class="w-10 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400 flex items-center justify-center">
                                    <div>
                                        <span class="text-2xl font-thin leading-none">-</span>
                                    </div>
                                </button>
                                <input type="number" wire:model="quantity" readonly
                                    class="flex items-center w-12 font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                    placeholder="1">
                                <button wire:click="increaseQuantity"
                                    class="w-10 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400 flex items-center justify-center">
                                    <div>
                                        <span class="text-2xl font-thin leading-none">+</span>
                                    </div>
                                </button>
                                <span class="ml-5 mt-2 text-md text-base text-gray-500 dark:text-white"
                                    wire:model.live="stock">Stock:
                                    @if ($product->stock === 0)
                                        0
                                    @else
                                        {{ $stock }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center gap-4">
                            @if ($product->stock > 0)
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="w-full p-4 bg-blue-500 rounded-md lg:w-2/5 dark:text-gray-200 text-gray-50 hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-700 flex justify-center items-center space-x-2">
                                    <svg wire:target="addToCart({{ $product->id }})" wire:loading.class="hidden"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                        </path>
                                    </svg>
                                    <span wire:loading.class="hidden" wire:target="addToCart({{ $product->id }})">Add
                                        to
                                        Cart</span>
                                    <span wire:loading wire:loading.class.remove="hidden" class="hidden"
                                        wire:target="addToCart({{ $product->id }})">
                                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Adding...
                                    </span>
                                </button>
                            @else
                                <button
                                    class="w-full p-4 bg-gray-500 rounded-md lg:w-2/5 dark:text-white text-gray-50 hover:bg-gray-600 dark:bg-gray-500 dark:hover:bg-gray-700 flex justify-center items-center space-x-2">
                                    Out of Stock!
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
