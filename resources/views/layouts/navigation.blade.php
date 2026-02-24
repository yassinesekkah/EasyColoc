<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-indigo-600 tracking-tight">EasyColoc</span>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold text-gray-700">John Doe</span>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Member</span>
                </div>

                <div class="relative group">
                    <button
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-300 transition">
                        <img class="h-10 w-10 rounded-full object-cover shadow-sm"
                            src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff"
                            alt="User avatar">
                    </button>
                    <div
                        class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-xl border border-gray-100 hidden group-hover:block">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Your
                            Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
