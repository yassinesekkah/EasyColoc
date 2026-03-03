<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('colocations.index') }}" class="text-2xl font-bold text-indigo-600 tracking-tight">
                    EasyColoc
                </a>
            </div>

            {{-- User Section --}}
            <div class="flex items-center space-x-4">

                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </span>

                </div>
                
                {{-- Avatar Dropdown --}}
                <div class="relative">
                    <button id="userMenuBtn"
                        class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <img class="h-10 w-10 rounded-full object-cover shadow"
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4f46e5&color=fff"
                            alt="User avatar">
                    </button>

                    <div id="userDropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

                        <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition">
                            👤 Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>

<script>
    const btn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');

    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
