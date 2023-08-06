<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- toasterメッセージ -->  
        <x-toastr status="session('status')" />
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
                     <div class="md:w-2/12">
                        <form method="post" action="{{ route('user.cart.delete',['item' => $product->id])}}">
                            @csrf
                            <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg></button>
                        </form>
                    </div>
                     </div>
                     @endforeach
                     <div class="my-2 text-xl">
                        小計：{{ number_format($totalPrice) }}<span class="text-sm text-white">円(税込)</span>
                     </div>
                     <div>
                        <button class="flex ml-auto mr-3 text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-700 rounded" onclick="location.href='{{route('user.cart.checkout')}}'">購入</button>
                    </div>
                     @else 
                     カートに商品がありません。
                     @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
