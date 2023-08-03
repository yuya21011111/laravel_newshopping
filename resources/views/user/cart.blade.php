<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   @if(count($products) > 0)
                     @foreach($products as $product)
                     <div class="md:flex md:items-center mb-2">
                     <div class="md:w-3/12">
                        @if($product->imageFirst->filename !== null)
                        <img src="{{ asset('storage/products/' . $product->imageFirst->filename) }}">
                      @else 
                        <img src="">
                      @endif
                    </div>
                     <div class="md:w-4/12 md:ml-2">{{ $product->name }}</div>
                     <div class="md:w-3/12 flex justify-around">
                       <div> {{ $product->pivot->quantity }}個</div>
                       <div>{{ number_format($product->pivot->quantity * $product->price) }}円</div><span class="text-sm mr-12 text-red-400">（税込）<span>
                    </div>
                     <div class="md:w-2/12">削除ボタン</div>
                     </div>
                     @endforeach
                     合計金額：{{ $totalPrice }}
                     @else 
                     カートに商品がありません。
                     @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
