<x-guest-layout>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

         <!-- Confirm Password -->
         <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（再確認）')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- post -->
        <div class="mt-4">
            <x-input-label for="post" :value="__('郵便番号')" />

            <x-text-input id="post" class="block mt-1 w-full"
                            type="text"
                            name="post"
                            required />

            <x-input-error :messages="$errors->get('post')" class="mt-2" />
        </div>


        <!-- addres -->
        <div class="mt-4">
            <x-input-label for="addres" :value="__(' 住所')" />

            <x-text-input id="addres" class="block mt-1 w-full"
                            type="text"
                            name="addres"
                            required />

            <x-input-error :messages="$errors->get('addres')" class="mt-2" />
        </div>

        <!-- birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('誕生日')" />

            <x-text-input id="birthday" class="block mt-1 w-full"
                            type="date"
                            name="birthday"
                            required />

            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

       

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.login') }}">
                {{ __('パスワードをお忘れですか?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('新規作成') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
