<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400"> Categories</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($categories as $category)
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400 ">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Product Status</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="featured" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" id="featured" wire:model.live="featured"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">Is Featured</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <div>
                            <div class="font-semibold dark:text-white">Rp.
                                {{ number_format($price_range, 0, ',', '.') }}</div>
                            <input type="range" wire:model.live="price_range"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                min="10000" max="1000000" value="10000" step="10000">
                            <div class="flex justify-between ">
                                <span class="inline-block text-lg font-bold text-blue-400 ">Rp.
                                    {{ number_format(10000, 0, ',', '.') }}</span>
                                <span class="inline-block text-lg font-bold text-blue-400 ">Rp.
                                    {{ number_format(1000000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div class="items-center justify-between px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900">
                            <div class="flex items-center gap-4 w-full">
                                <select wire:model.live="sort"
                                    class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900 border-transparent focus:border-transparent focus:ring-0">
                                    <option value="latest">Sort by latest</option>
                                    <option value="price">Sort by price</option>
                                    <option value="stock">Sort by available</option>
                                </select>
                                <div class="flex items-center gap-2 bg-white rounded-lg dark:bg-gray-900 w-full">

                                    <input type="text" id="hero-input" wire:model.live="searchByName"
                                        class="flex-1 py-2 px-4 block w-full border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                                        placeholder="Find your clothes..." autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center ">

                        @foreach ($products as $product)
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                                <div class="border border-gray-300 dark:border-gray-700">
                                    <div class="relative bg-gray-200">
                                        <a href="{{ route('product-detail', ['product' => $product->slug]) }}">
                                            <img src="{{ url('storage/' . $product->images[0]) }}"
                                                alt="{{ $product->name }}"
                                                class="object-cover w-full h-56 mx-auto 
                                                @if ($product->stock === 0) grayscale @endif">
                                        </a>
                                    </div>
                                    <div class="p-3 ">
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <h3 class="text-xl font-medium dark:text-gray-400">
                                                {{ $product->name }}
                                            </h3>
                                        </div>
                                        <p class="text-lg ">
                                            <span class="text-green-600 dark:text-green-600">Rp.
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                    <div
                                        class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700 bg-blue-500 dark:bg-blue-900 @if ($product->stock === 0) bg-gray-500 dark:bg-gray-900 @endif">
                                        @if ($product->stock > 0)
                                            <a wire:click.prevent="addToCart({{ $product->id }})" href="/"
                                                class="flex items-center justify-center space-x-2 text-gray-100 dark:hover:text-blue-500 w-full">
                                                <svg wire:target="addToCart({{ $product->id }})"
                                                    wire:loading.class="hidden" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                    </path>
                                                </svg>
                                                <span wire:loading.class="hidden"
                                                    wire:target="addToCart({{ $product->id }})">Add to Cart</span>
                                                <span wire:loading wire:loading.class.remove="hidden" class="hidden"
                                                    wire:target="addToCart({{ $product->id }})">
                                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline-block"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Adding...
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ route('product-detail', ['product' => $product->slug]) }}"
                                                class="flex items-center justify-center space-x-2 text-gray-100 dark:text-white w-full bg-gray-500 dark:bg-gray-900">
                                                Out of Stock!
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>

</div>
