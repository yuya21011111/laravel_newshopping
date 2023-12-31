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
            <!-- toasterメッセージ -->  
            <x-toastr status="session('status')" />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('owner.products.update',['product' => $product->id]) }}">
                        @csrf
                        @method('put')
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-white">商品名</label>
                                    <input type="text" id="name" name="name" value="{{ $product->name }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="information" class="leading-7 text-sm text-white">商品情報</label>
                                    <textarea id="information" name="information" rows="10" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-white">価格</label>
                                    <input type="number" id="price" name="price" value="{{ $product->price }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="sort_orer" class="leading-7 text-sm text-white">表示順</label>
                                    <input type="number" id="sort_order" name="sort_order"
                                        value="{{ $product->sort_order }}" required
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
                                            <option value="{{ $shop->id }}" @if($shop->id === $product->shop_id) selected @endif>
                                                {{ $shop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="current_quantity" class="leading-7 text-sm text-white">在庫数</label>
                                    <input type="hidden" id="current_quantity" name="current_quantity" value="{{ $quantity }}" />
                                    <div class="w-full bg-gray-100 bg-opacity-50 rounded ">{{ $quantity }}</div>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative flex justify-around">
                                    <div><input type="radio" name="type" value="1" class="mr-2" checked />＋
                                    </div>
                                    <div><input type="radio" name="type" value="2" class="mr-2" />ー
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="quantity" class="leading-7 text-sm text-white">数量</label>
                                    <input type="number" id="quantity" name="quantity" value= "0"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <span class="text-sm text-red-600">数量にマイナスの値は入力しないで下さい。</span>
                                </div>
                            </div>

                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select class="text-blue-700" name="category">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                <option value="0">選択してください。</option>
                                                @foreach ($category->secondary as $secondary)
                                                    <option value="{{ $secondary->id }}" @if($secondary->id === $product->secondary_category_id) selected  @endif>
                                                        {{ $secondary->name }}
                                                    </option>
                                                @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Micromodal -->
                        <x-select-image :images="$images" currentId="{{ $product->image1 }}" currentImage="{{ $product->imageFirst->filename ?? '' }}" name="image1" />
                        <x-select-image :images="$images" currentId="{{ $product->image2 }}" currentImage="{{ $product->imageSecond->filename ?? '' }}"  name="image2" />
                        <x-select-image :images="$images" currentId="{{ $product->image3 }}" currentImage="{{ $product->imageThird->filename ?? '' }}"  name="image3" />
                        <x-select-image :images="$images" currentId="{{ $product->image4 }}" currentImage="{{ $product->imageFourth->filename ?? '' }}"  name="image4" />
                        <x-select-image :images="$images" currentId="{{ $product->image5 }}" currentImage="{{ $product->imageFifth->filename ?? '' }}"  name="image5" />
                        <div class="p-2 w-1/2 mx-auto">
                            <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2" @if($product->is_selling === 1){ checked }  @endif/>販売中
                                </div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2" @if($product->is_selling === 0){ checked }  @endif />停止中
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"
                                class=" text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit"
                                class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                        </div>
                        <div id="page_top"
                            class="fixed bottom-8 right-8 rounded-full w-24 py-9 bg-green-300 text-white text-center ring-4 ring-offset-4 ring-offset-blue">
                            TOPへ戻る
                        </div>
                    </form>
                    <form id="delete_{{$product->id}}" method="post" action="{{ route('owner.products.destroy' ,['product' => $product->id]) }}">
                        @csrf
                        @method('delete')
                      <div class="flex justify-center">
                        <a href="#" data-id="{{$product->id}}" onclick="deletePost(this)" class="w-12 h-12  py-2 pl-1.5   bg-red-400 text-lg text-white font-semibold rounded-full hover:bg-red-500">削除</a>
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
                element.preventDefault()
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

        // 削除処理
        function deletePost(e) {
          'use stricr';
          if(confirm('本当に削除してもいいですか？（2度と復元はできません）')){
            document.getElementById('delete_' + e.dataset.id).submit();
          }
        }
    
    </script>
</x-app-layout>
