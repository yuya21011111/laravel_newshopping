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
                   @foreach($shops as $shop)
                   <div class="w-1/4 p -4">
                    <a href="{{ route('owner.shops.edit',['shop' => $shop->id]) }}">
                    <div class="border rounded-md p-4">
                        <div class="mb-4">
                            @if($shop->is_selling)
                            <span class="border p-2 rounded-md bg-blue-400 text-white">販売中
                            @else
                            <span class="border p-2 rounded-md bg-red-400 text-white">販売中
                            @endif
                        </div>
                     <div class="text-xl">{{ $shop->name }}</div>
                     <div>
                        @if(empty($shop->filename))
                          <img src="{{ asset('images/no_images.png') }}">
                        @else
                          <img src="{{ asset('storage/shops' . $shop->filename) }}">
                        @endif
                     </div>
                    </div>
                    </a>
                   </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
