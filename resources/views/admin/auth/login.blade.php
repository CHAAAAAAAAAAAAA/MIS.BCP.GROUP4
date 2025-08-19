<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-center text-red-600">Admin Login</h2>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

    
        <div class="flex flex-col mt-4 w-full">
            <!-- Links -->
            <div class="mb-2 flex flex-col space-y-1">
                @if (Route::has('register'))
                    <a class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                        href="{{ route('admin.register') }}" 
                        style="color: #1447e6 !important;">
                        {{ __('Don’t have an account yet?') }}
                    </a>
                @endif
        
                @if (Route::has('password.request'))
                    <a class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  
                        href="{{ route('password.request') }}"
                        style="color: #1447e6 !important;">
                        {{--{{ __('Forgot your password?') }}--}}
                    </a>
                @endif
            </div>

            <a class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ url('/login') }}"
                    style="color: #1447e6 !important;">
                    {{ __('Back') }}
                    </a>
                </div>

            <!-- Login Button -->
            <div class="flex justify-end w-full">
                <x-primary-button class="w-auto px-6 py-2">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
        
    </form>
</x-guest-layout>
