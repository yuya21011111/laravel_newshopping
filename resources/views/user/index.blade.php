<x-app-layout>
    <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             商品一覧
          </h2>
            <form method="get" action="{{ route('user.items.index') }}">
             <div class="lg:flex lg:justify-around">
                <div class="lg:flex items-center">
                    <select name="category" class="mb-2 lg:mb-0 lg:mr-2">
                        <option value="0">全て</option>
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
                    <div class="flex space-x-2 items-center">
                        <div><input name="keyword" class="border border-gray-500 py-2"  placeholder="キーワードを入力"></div>
                        <div><button class="ml-auto  text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-700 rounded">検索</button></div>
                    </div>
                </div>
                <div class="flex">
                    
                </div>
                <div class="flex">
                    <div>
                        <span class="text-white text-sm">表示順</span><br>
                        <select id="sort" name="sort" class="mr-4">
                            <option value="{{ \Constant::SORT_ORDER['recommend']}}"
                            @if(\Request::get('sort') === \Constant::SORT_ORDER['recommend'])
                            selected
                            @endif>おすすめ順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['higherPrice']}}"
                            @if(\Request::get('sort') === \Constant::SORT_ORDER['higherPrice'])
                            selected
                            @endif>料金の高い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['lowerPrice']}}"
                            @if(\Request::get('sort') === \Constant::SORT_ORDER['lowerPrice'])
                            selected
                            @endif>料金の低い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['later']}}"
                            @if(\Request::get('sort') === \Constant::SORT_ORDER['later'])
                            selected
                            @endif>新しい順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['older']}}"
                            @if(\Request::get('sort') === \Constant::SORT_ORDER['older'])
                            selected
                            @endif>古い順
                            </option>
                        </select>
                    </div>
                    <div>
                        <span class="text-white text-sm">表示件数</span><br>
                        <select id="pagination" name="pagination">
                            <option value="10" 
                            @if(\Request::get('pagination') === '10')
                            selected
                            @endif>10件
                            </option>
                            <option value="20" 
                            @if(\Request::get('pagination') === '20')
                            selected
                            @endif>20件
                            </option>
                            <option value="50" 
                            @if(\Request::get('pagination') === '50')
                            selected
                            @endif>50件
                            </option>
                            <option value="100" 
                            @if(\Request::get('pagination') === '100')
                            selected
                            @endif>100件
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            </form>
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

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}


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
          {{ $products->appends([
            'sort' => \Request::get('sort'),
            'pagination' => \Request::get('pagination')
          ])->links() }}
        </div>
      </div>
      <script>
        const select = document.getElementById('sort')
        select.addEventListener('change',function(){
            this.form.submit()
        })

        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change',function(){
            this.form.submit()
        })
      </script>
</x-app-layout>
