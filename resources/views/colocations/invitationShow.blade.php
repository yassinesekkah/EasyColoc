<x-app-layout>
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-md w-full">

            <div class="text-center mb-8">
                <span class="text-2xl font-black text-indigo-600 tracking-tighter">EasyColoc</span>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="h-2 bg-green-500"></div>

                <div class="p-8">
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-green-50 text-green-600 rounded-full mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2 m8-10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl font-black text-gray-900 tracking-tight">You're Invited!</h1>
                        <p class="mt-2 text-sm text-gray-500 font-medium">Someone wants to share a home with you.</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100 space-y-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Colocation</p>
                            <p class="text-lg font-bold text-gray-900">{{ $invitation->colocation->name }}</p>
                        </div>

                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Invited By
                                </p>
                                <p class="text-sm font-semibold text-gray-700">{{ $invitation->inviter->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">For
                                    Account</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $invitation->email }}</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('invitations.process', $invitation->token) }}"
                        class="space-y-3">
                        @csrf

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-100 transition-all flex items-center justify-center gap-2 group active:scale-[0.98]">
                            <span>Accept Invitation</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </form>

                    @if ($invitation->status === 'pending')
                        <form method="POST" action="{{ route('invitations.refuse', $invitation->token) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                class="block w-full text-center py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                                Refuse
                            </button>

                        </form>
                    @endif
                </div>
            </div>

            <p class="mt-8 text-center text-xs text-gray-400 px-4 leading-relaxed">
                By accepting, you will gain access to shared expenses, settlements, and member details for
                <strong>{{ $invitation->colocation->name }}</strong>.
            </p>
        </div>
    </div>
</x-app-layout>
