<x-guest-layout>
    <div class="flex min-h-screen bg-white">
        
        <div class="hidden lg:flex w-1/2 bg-gray-50 items-center justify-center border-r border-gray-100">
            <div class="max-w-md text-center p-8">
                <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 mb-4">
                    Easy<span class="text-indigo-600">Coloc</span>
                </h1>
                <p class="text-lg text-gray-500 font-medium leading-relaxed">
                    Join our community and find your next home or roommate today.
                </p>
                <div class="mt-12 opacity-20">
                    <svg class="w-64 h-64 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-[350px]">
                
                <div class="lg:hidden text-center mb-10">
                    <h1 class="text-4xl font-black tracking-tighter text-gray-900">EasyColoc</h1>
                </div>

                <div class="bg-white lg:border lg:border-gray-200 lg:p-10 rounded-sm shadow-sm lg:shadow-none">
                    <h2 class="text-xl font-semibold text-center mb-4 text-gray-800">Sign Up</h2>
                    <p class="text-sm text-gray-500 text-center mb-8 font-medium">
                        Sign up to see photos and find roommates.
                    </p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <input id="name" 
                                   class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-1 focus:ring-gray-300 focus:border-gray-400 placeholder-gray-400 transition-all" 
                                   type="text" name="name" :value="old('name')" 
                                   placeholder="Full Name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                        </div>

                        <div class="mb-3">
                            <input id="email" 
                                   class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-1 focus:ring-gray-300 focus:border-gray-400 placeholder-gray-400 transition-all" 
                                   type="email" name="email" :value="old('email')" 
                                   placeholder="Email address" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                        </div>

                        <div class="mb-3">
                            <input id="password" 
                                   class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-1 focus:ring-gray-300 focus:border-gray-400 placeholder-gray-400 transition-all" 
                                   type="password" name="password" 
                                   placeholder="Password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                        </div>

                        <div class="mb-6">
                            <input id="password_confirmation" 
                                   class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:ring-1 focus:ring-gray-300 focus:border-gray-400 placeholder-gray-400 transition-all" 
                                   type="password" name="password_confirmation" 
                                   placeholder="Confirm Password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg text-sm transition duration-200 shadow-sm">
                            Sign Up
                        </button>

                        <p class="text-[11px] text-gray-400 text-center mt-6">
                            By signing up, you agree to our <strong>Terms</strong>, <strong>Privacy Policy</strong> and <strong>Cookies Policy</strong>.
                        </p>
                    </form>
                </div>

                <div class="mt-4 bg-white lg:border lg:border-gray-200 p-6 text-center rounded-sm shadow-sm lg:shadow-none">
                    <p class="text-sm text-gray-600">
                        Have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-indigo-800">Log in</a>
                    </p>
                </div>

                <div class="mt-8 flex justify-center space-x-4 text-[10px] text-gray-400 uppercase font-bold tracking-tight">
                    <span>About</span>
                    <span>Privacy</span>
                    <span>Terms</span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>