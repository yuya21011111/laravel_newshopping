<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="flex justify-center items-center text-lg mb-4" :errors="$errors" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('owner.shops.update', ['shop' => $shop->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">店名</label>
                                    <input type="text" id="name" name="name" value="{{ $shop->name }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="information" class="leading-7 text-sm text-gray-600">店舗情報</label>
                                    <textarea id="information" name="information" rows="10" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shop->information }}
                                  </textarea>
                                </div>
                            </div>
                            <!-- 画像表示 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <div class="w-32">
                                        <x-shop-thumbnail />
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="image"
                                        class="border p-2  rounded-md bg-blue-400 text-white">画像</label>
                                    <input type="file" id="image" name="image"
                                        class="w-full mt-4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <span class="text-sm text-red-500">※選択するファイルは必ず画像ファイルにして下さい。</span><br>
                                    <span class="text-sm text-red-500">※登録できる画像ファイルは（jpg/jpeg/png）になります。</span><br>
                                    <span class="text-sm text-red-500">※ファイルサイズは4MB以内でお願いします。</span><br>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative flex justify-around">
                                    <div><input type="radio" name="is_selling" value="1" class="mr-2"
                                        @if ($shop->is_selling === 1) {checked} @endif />販売中
                                    </div>
                                    <div><input type="radio" name="is_selling" value="0" class="mr-2"
                                        @if ($shop->is_selling === 0) {checked} @endif />停止中
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('owner.shops.index') }}'"
                                class=" text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit"
                                class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
