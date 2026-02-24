<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6 font-sans antialiased">

    <nav class="absolute top-0 left-0 right-0 h-16 bg-white border-b border-gray-100 flex items-center px-8">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <span class="text-xl font-black tracking-tight text-indigo-600">EasyColoc</span>
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-500">Yassine Karim</span>
                <form action="#" method="POST">
                    <button
                        class="text-xs font-bold uppercase text-gray-400 hover:text-red-500 transition">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-md w-full text-center">
        <div class="mb-8 inline-flex items-center justify-center w-24 h-24 bg-indigo-50 rounded-full">
            <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-indigo-100/50 border border-gray-100">
            <h1 class="text-2xl font-black text-gray-900 mb-4 tracking-tight">No Colocation Yet</h1>

            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                EasyColoc helps you track expenses and manage bills with your roommates. Start your journey by creating
                a new home or joining one you were invited to.
            </p>

            <div class="space-y-4">
                <a href="{{ route('colocations.create') }}"
                    class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-1">
                    Create Colocation
                </a>

                <button
                    class="w-full bg-white border-2 border-gray-100 hover:border-indigo-100 hover:bg-indigo-50/30 text-gray-700 font-bold py-4 rounded-2xl transition-all">
                    Join via Invitation
                </button>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-50">
                <p class="text-xs text-gray-400 font-medium italic">
                    Tip: Ask your roommate for the 6-digit invite code.
                </p>
            </div>
        </div>

        <div class="fixed -bottom-20 -left-20 w-80 h-80 bg-indigo-200/20 rounded-full blur-3xl"></div>
        <div class="fixed -top-20 -right-20 w-80 h-80 bg-blue-200/20 rounded-full blur-3xl"></div>
    </div>
</div>
