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
                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('owner.products.create') }}'" class=" text-white bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録</button>
                    </div>
                <div class="flex flex-wrap">
                   @foreach($owners as $owner)
                     @foreach($owner->shop->product as $product)
                   <div class="w-1/4 p-2 md:p-4">
                    <a href="{{ route('owner.products.edit',['product' => $product->id]) }}">
                    <div class="border rounded-md p-2 md:p-4">
                     <!-- 画像表示 -->
                     <x-shop-thumbnail :filename="$product->imageFirst->filename" type="products" />
                        <div class="text-white">{{ $product->name }}</div>
                    </div>
                    </a>
                   </div>
                     @endforeach
                   @endforeach
                </div>
                   {{-- {{ $products->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
