<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        
        <div class="hidden lg:flex w-1/2 bg-gray-50 items-center justify-center border-r border-gray-100">
            <div class="max-w-md text-center p-8">
                <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 mb-4">
                    Easy<span class="text-indigo-600">Coloc</span>
                </h1>
                <p class="text-lg text-gray-500 font-medium">
                   Find your perfect roommate in just a few clicks. 
                    Simple, fast, and secure.
                </p>
                <div class="mt-12 opacity-20">
                    <svg class="w-64 h-64 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-[350px]"> <div class="lg:hidden text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">EasyColoc</h1>
                </div>

                <div class="bg-white lg:border lg:border-gray-200 lg:p-10 rounded-sm">
                    <h2 class="text-xl font-semibold text-center mb-8 text-gray-800">Log In</h2>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input id="email" 
                                   class="block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-0 focus:border-gray-400 placeholder-gray-400" 
                                   type="email" name="email" :value="old('email')" 
                                   placeholder="Email address" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                        </div>

                        <div class="mb-4">
                            <input id="password" 
                                   class="block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-0 focus:border-gray-400 placeholder-gray-400" 
                                   type="password" name="password" 
                                   placeholder="Password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-xs text-gray-600 italic">Remember me</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg text-sm transition duration-150">
                            Log In
                        </button>

                        <div class="relative flex py-5 items-center">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink mx-4 text-gray-400 text-xs font-bold uppercase">OU</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-xs text-indigo-900 font-medium" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="mt-4 bg-white lg:border lg:border-gray-200 p-6 text-center rounded-sm">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>