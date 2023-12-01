<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-white"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telephone Number -->
        <div class="mt-4">
            <x-input-label for="telephone_number" :value="__('Telephone Number')" class="text-white"/>
            <div class="flex justify-center items-center w-full">
                <div class=" w-2/12 mt-1 border-white border-l border-y  p-2 bg-gray-900 rounded-l-lg">
                    +62
                </div>
                 <x-text-input id="telephone_number" class=" block rounded-none rounded-r-lg mt-1 w-10/12" type="text" name="telephone_number" :value="old('telephone_number')" required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('telephone_number')" class="mt-2" />
        </div>

        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center flex-col justify-end mt-10">
            <x-primary-button class="w-full mb-4 hover:text-black hover:bg-gray-200">
                {{ __('Register') }}
            </x-primary-button>
            
            <div class="flex ">
                <div class="text-sm text-gray-500">
                    Already have an account?
                </div>
                <a class="ml-2 mb-2 text-sm text-gray-300  hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Log In') }}
                </a>
            </div>
           

        </div>
    </form>
</x-guest-layout>
