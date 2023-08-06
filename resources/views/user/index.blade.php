<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           ホーム
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap">
                        @foreach($products as $product)
                        <div class="w-1/4 p-2 md:p-4">
                         <a href="{{ route('owner.products.edit',['product' => $product->id]) }}">
                         <div class="border rounded-md p-2 md:p-4">
                          <!-- 画像表示 -->
                          <x-shop-thumbnail filename="{{$product->imageFirst->filename ?? ''}}" type="products" />
                             <div class="text-white">{{ $product->name }}</div>
                         </div>
                         </a>
                        </div>
                        @endforeach
                     </div>
                </div>
            </div>
        </div>
    </div> --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="bg-white">
         <!-- toasterメッセージ -->  
         <x-toastr status="session('status')" />
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
          <h2 class="text-2xl font-bold tracking-tight text-gray-900">Gereens!</h2>
          <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach($products as $product)
            <div class="group relative">
              <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                <a href="{{ route('user.items.show',['item' => $product->id]) }}">
                <x-shop-thumbnail filename="{{$product->filename ?? ''}}" type="products" />
                <h3 class="text-sm text-gray-700">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{$product->category}}
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ $product->name }}</p>
              </div>
                <div class="flex justify-end">
                <p class="mb-4  text-gray-900">{{ number_format($product->price) }}円</p><span class="text-sm text-red-500">（税込）</span>
            </a>    
            </div>
            </div>
            @endforeach
      
            <!-- More products... -->
          </div>
        </div>
      </div>
    
</x-app-layout>
