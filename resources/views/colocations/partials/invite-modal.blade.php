<div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" @keydown.escape.window="open = false">

    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-2xl bg-white p-8 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md"
            @click.away="open = false">

            <button @click="open = false"
                class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-6 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 mb-4">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 tracking-tight">Invite a Member</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Send an invitation email to add a new roommate to your colocation.
                </p>
            </div>

            <form action="{{ route('invitations.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                <div>
                    <label for="email"
                        class="block text-[11px] font-bold uppercase tracking-[0.1em] text-gray-400 mb-2">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        placeholder="roommate@example.com"
                        class="block w-full rounded-xl border-gray-200 px-4 py-3 text-sm text-gray-900 shadow-sm transition-all focus:border-indigo-500 focus:ring-indigo-500 placeholder:text-gray-300 @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="mt-2 text-xs font-bold text-red-500 flex items-center gap-1">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-[0.98]">
                        Send Invitation
                    </button>
                    <button type="button" @click="open = false"
                        class="inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-500 transition-colors hover:text-gray-700">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
