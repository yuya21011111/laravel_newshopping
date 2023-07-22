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
                    <form method="post" action="{{ route('owner.images.update',['image' => $image->id]) }}">
                        @csrf
                        @method('put')
                        <div class="-m-2">   
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="title"
                                        class="border p-2  rounded-md bg-blue-400 text-white">画像タイトル</label>
                                    <input type="text" id="title" name="title" value="{{ $image->title }}"
                                        class="w-full mt-4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                        </div>
                         <!-- 画像表示 -->
                         <div class="p-4  mx-auto md:p-4">
                            <div class="flex justify-center">
                                <div class="w-64">
                                    <x-shop-thumbnail :filename="$image->filename" type="products"  />
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-full flex justify-center mt-4">
                            <button type="button" onclick="location.href='{{ route('owner.images.index') }}'"
                                class=" text-black bg-gray-200 border-0 py-2 px-8 mr-4 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit"
                                class=" text-white bg-indigo-500 border-0 py-2 px-8 mr-4 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                        </div>
                    </form>
                    <form id="delete_{{$image->id}}" method="post" action="{{ route('owner.images.destroy' ,['image' => $image->id]) }}">
                        @csrf
                        @method('delete')
                      <div class="flex justify-end">
                        <a href="#" data-id="{{$image->id}}" onclick="deletePost(this)" class="w-12 h-12  py-2 pl-1.5   bg-red-400 text-lg text-white font-semibold rounded-full hover:bg-red-500">削除</a>
                      </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
          'use stricr';
          if(confirm('本当に削除してもいいですか？（2度と復元はできません）')){
            document.getElementById('delete_' + e.dataset.id).submit();
          }
        }
      </script>
</x-app-layout>