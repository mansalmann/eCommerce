<div>
    <div class="w-full h-screen bg-gradient-to-r from-blue-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1
                        class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Find your best suit in <span class="text-blue-600">OnlineClothing</span></h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Purchase wide varities of clothes such as
                        t-shirt, shirt, skirt, pants, and many more!</p>

                    <!-- Buttons -->
                    <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="{{ route('products') }}">
                            Explore our products
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/https://github.com/mansalmann">
                            About me
                        </a>
                    </div>
                    <!-- End Buttons -->

                    <!-- Review -->
                    {{-- <div class="mt-6 lg:mt-10 grid grid-cols-2 gap-x-5">
                    <!-- Review -->
                    <div class="py-5">
                      <div class="flex space-x-1">
                        <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                        </svg>
                        <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                        </svg>
                        <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                        </svg>
                        <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                        </svg>
                        <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                        </svg>
                      </div>

                      <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">
                        <span class="font-bold">4.6</span> /5 - from 12k reviews
                      </p>

                      <div class="mt-5">
                        <!-- Star -->
                        <svg class="h-auto w-16 text-gray-800 dark:text-white" width="80" height="27" viewBox="0 0 80 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M20.558 9.74046H11.576V12.3752H17.9632C17.6438 16.0878 14.5301 17.7245 11.6159 17.7245C7.86341 17.7245 4.58995 14.7704 4.58995 10.6586C4.58995 6.62669 7.70373 3.51291 11.6159 3.51291C14.6498 3.51291 16.4063 5.42908 16.4063 5.42908L18.2426 3.51291C18.2426 3.51291 15.8474 0.878184 11.4961 0.878184C5.94724 0.838264 1.67578 5.50892 1.67578 10.5788C1.67578 15.5289 5.70772 20.3592 11.6558 20.3592C16.8854 20.3592 20.7177 16.8063 20.7177 11.4969C20.7177 10.3792 20.558 9.74046 20.558 9.74046Z" fill="currentColor" />
                          <path d="M27.8621 7.78442C24.1894 7.78442 21.5547 10.6587 21.5547 14.012C21.5547 17.4451 24.1096 20.3593 27.9419 20.3593C31.415 20.3593 34.2094 17.7645 34.2094 14.0918C34.1695 9.94011 30.896 7.78442 27.8621 7.78442ZM27.902 10.2994C29.6984 10.2994 31.415 11.7764 31.415 14.0918C31.415 16.4072 29.7383 17.8842 27.902 17.8842C25.906 17.8842 24.3491 16.2874 24.3491 14.0519C24.3092 11.8962 25.8661 10.2994 27.902 10.2994Z" fill="currentColor" />
                          <path d="M41.5964 7.78442C37.9238 7.78442 35.2891 10.6587 35.2891 14.012C35.2891 17.4451 37.844 20.3593 41.6763 20.3593C45.1493 20.3593 47.9438 17.7645 47.9438 14.0918C47.9038 9.94011 44.6304 7.78442 41.5964 7.78442ZM41.6364 10.2994C43.4328 10.2994 45.1493 11.7764 45.1493 14.0918C45.1493 16.4072 43.4727 17.8842 41.6364 17.8842C39.6404 17.8842 38.0835 16.2874 38.0835 14.0519C38.0436 11.8962 39.6004 10.2994 41.6364 10.2994Z" fill="currentColor" />
                          <path d="M55.0475 7.82434C51.6543 7.82434 49.0195 10.7784 49.0195 14.0918C49.0195 17.8443 52.0934 20.3992 54.9676 20.3992C56.764 20.3992 57.6822 19.7205 58.4407 18.8822V20.1198C58.4407 22.2754 57.1233 23.5928 55.1273 23.5928C53.2111 23.5928 52.2531 22.1557 51.8938 21.3573L49.4587 22.3553C50.297 24.1517 52.0135 26.0279 55.0874 26.0279C58.4407 26.0279 60.9956 23.9122 60.9956 19.481V8.18362H58.3608V9.26147C57.6423 8.38322 56.5245 7.82434 55.0475 7.82434ZM55.287 10.2994C56.9237 10.2994 58.6403 11.7365 58.6403 14.1317C58.6403 16.6068 56.9636 17.9241 55.2471 17.9241C53.4507 17.9241 51.774 16.4471 51.774 14.1716C51.8139 11.6966 53.5305 10.2994 55.287 10.2994Z" fill="currentColor" />
                          <path d="M72.8136 7.78442C69.62 7.78442 66.9453 10.2994 66.9453 14.0519C66.9453 18.004 69.9393 20.3593 73.093 20.3593C75.7278 20.3593 77.4044 18.8822 78.3625 17.6048L76.1669 16.1277C75.608 17.006 74.6499 17.8443 73.093 17.8443C71.3365 17.8443 70.5381 16.8862 70.0192 15.9281L78.4423 12.4152L78.0032 11.3772C77.1649 9.46107 75.2886 7.78442 72.8136 7.78442ZM72.8934 10.2196C74.0511 10.2196 74.8495 10.8184 75.2487 11.5768L69.6599 13.9321C69.3405 12.0958 71.097 10.2196 72.8934 10.2196Z" fill="currentColor" />
                          <path d="M62.9531 19.9999H65.7076V1.47693H62.9531V19.9999Z" fill="currentColor" />
                        </svg>
                        <!-- End Star -->
                      </div>
                    </div>
                    <!-- End Review -->
                  </div> --}}
                    <!-- End Review -->
                </div>
                <!-- End Col -->

                <div class="relative ms-4">
                    <img class="w-full rounded-md"
                        src="https://static.vecteezy.com/system/resources/previews/011/993/278/non_2x/3d-render-online-shopping-bag-using-credit-card-or-cash-for-future-use-credit-card-money-financial-security-on-mobile-3d-application-3d-shop-purchase-basket-retail-store-on-e-commerce-free-png.png"
                        alt="Image Description">
                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>

                    <!-- SVG-->
                    <div class="absolute bottom-0 start-0">
                        <svg class="w-2/3 ms-auto h-auto text-white dark:text-slate-900" width="630" height="451"
                            viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="531" y="352" width="99" height="99" fill="currentColor" />
                            <rect x="140" y="352" width="106" height="99" fill="currentColor" />
                            <rect x="482" y="402" width="64" height="49" fill="currentColor" />
                            <rect x="433" y="402" width="63" height="49" fill="currentColor" />
                            <rect x="384" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="531" y="328" width="50" height="50" fill="currentColor" />
                            <rect x="99" y="303" width="49" height="58" fill="currentColor" />
                            <rect x="99" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="99" y="392" width="49" height="59" fill="currentColor" />
                            <rect x="44" y="402" width="66" height="49" fill="currentColor" />
                            <rect x="234" y="402" width="62" height="49" fill="currentColor" />
                            <rect x="334" y="303" width="50" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="64" fill="currentColor" />
                            <rect x="482" y="123" width="49" height="49" fill="currentColor" />
                            <rect x="507" y="124" width="49" height="24" fill="currentColor" />
                            <rect x="531" y="49" width="99" height="99" fill="currentColor" />
                        </svg>
                    </div>
                    <!-- End SVG-->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div>

    {{-- Category Section --}}
    {{-- <div class="bg-orange-200 py-20">
  <div class="max-w-xl mx-auto">
    <div class="text-center ">
      <div class="relative flex flex-col items-center">
        <h1 class="text-5xl font-bold dark:text-gray-200"> Browse <span class="text-blue-500"> Categories
          </span> </h1>
        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
          <div class="flex-1 h-2 bg-blue-200">
          </div>
        </div>
      </div>
      <p class="mb-12 text-base text-center text-gray-500">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus magni eius eaque?
        Pariatur
        numquam, odio quod nobis ipsum ex cupiditate?
      </p>
    </div>
  </div>

  <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">

      @foreach ($categories as $category)
      <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#" wire:key="{{ $category->id }}">
        <div class="p-4 md:p-5">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <img class="h-[2.375rem] w-[2.375rem] rounded-full" src="{{ url("storage/". $category->image) }}" alt="{{ $category->name }}">
              <div class="ms-3">
                <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                  {{ $category->name }}
                </h3>
              </div>
            </div>
            <div class="ps-3">
              <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </div>
          </div>
        </div>
      </a>
      @endforeach

    </div>
  </div>

</div> --}}
    {{-- End Category Section --}}
</div>
