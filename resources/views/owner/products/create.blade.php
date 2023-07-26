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
                    <form method="post" action="{{ route('owner.products.store') }}">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-white">商品名</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="information" class="leading-7 text-sm text-white">商品情報</label>
                                    <textarea id="information" name="information" rows="10" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('information') }}</textarea>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-white">価格</label>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="sort_orer" class="leading-7 text-sm text-white">表示順</label>
                                    <input type="number" id="sort_order" name="sort_order"
                                        value="{{ old('soer_order') }}" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="shop_id" class="leading-7 text-sm text-white">店舗名</label>
                                    <select
                                        class="text-blue-700 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        id="shop_id" name="shop_id">
                                        @foreach ($shops as $shop)
                                            <option value="{{ $shop->id }}">
                                                {{ $shop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="quantity" class="leading-7 text-sm text-white">在庫数</label>
                                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <span class="text-sm text-red-600">数量にマイナスの値は入力しないで下さい。</span>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select class="text-blue-700" name="category">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                <option value="0">選択してください。</option>
                                                @foreach ($category->secondary as $secondary)
                                                    <option value="{{ $secondary->id }}">
                                                        {{ $secondary->name }}
                                                    </option>
                                                @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Micromodal -->
                        <x-select-image :images="$images" name="image1" />
                        <x-select-image :images="$images" name="image2" />
                        <x-select-image :images="$images" name="image3" />
                        <x-select-image :images="$images" name="image4" />
                        <x-select-image :images="$images" name="image5" />
                        <div class="p-2 w-1/2 mx-auto">
                            <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" checked />販売中
                                </div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" />停止中
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"
                                class=" text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit"
                                class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                        </div>
                        <div id="page_top"
                            class="fixed bottom-8 right-8 rounded-full w-24 py-9 bg-green-300 text-white text-center ring-4 ring-offset-4 ring-offset-blue">
                            TOPへ戻る
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        'use strict'
        const images = document.querySelectorAll('.image');
        images.forEach(image => {
            image.addEventListener('click', (element) => {
                const imageName = element.target.dataset.id.substr(0, 6);
                const imageId = element.target.dataset.id.replace(imageName + '_', '');
                const imageFile = element.target.dataset.file;
                const imagePath = element.target.dataset.path;

                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile;
                document.getElementById(imageName + '_hidden').value = imageId;

                /**
                 * MicroModal.close(modal);でモーダルを閉じるとimage4に適切な画像が配置出来なくなるのでis-openクラスを削除してモーダルを閉じる
                 * モーダルが開いている間はariaHiddenがfalseになるので閉じるタイミングでtrueに変更する
                 * モーダル表示時にbodyのoverflow属性にhiddenが設定されるので削除する
                 */
                const openModal = document.getElementsByClassName('is-open')[0];
                openModal.ariaHidden = true;
                openModal.classList.remove('is-open');
                document.getElementsByTagName('body')[0].style.overflow = '';
            })
        });

        const pagetop_btn = document.querySelector("#page_top");

        // .pagetopをクリックしたら
        pagetop_btn.addEventListener("click", scroll_top);

        // ページ上部に移動
        function scroll_top() {
            window.scroll({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>
</x-app-layout>
