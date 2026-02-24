<x-app-layout>
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-md w-full">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                    Create New Colocation
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Start a new shared space and manage your expenses effortlessly.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form method="POST" action="{{ route('colocations.store') }}" class="p-8 space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-400">
                            Colocation Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}" 
                            placeholder="e.g., The Sunny Loft"
                            class="block w-full px-4 py-3 rounded-xl border-gray-200 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder:text-gray-300 @error('name') border-red-500 @enderror"
                            required
                        >
                        
                        @error('name')
                            <p class="mt-1 text-xs font-bold text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100">
                        <p class="text-[11px] text-indigo-700 leading-relaxed italic">
                            <strong>Pro tip:</strong> You'll be able to invite your roommates and set up expense categories in the next step.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button 
                            type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-100 transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:scale-[0.98]"
                        >
                            Create Colocation
                        </button>
                        
                        <a 
                            href="{{ route('colocations.index') }}" 
                            class="w-full text-center py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-gray-400">
                You will be assigned as the <strong>Owner</strong> of this colocation.
            </p>
        </div>
    </div>
</x-app-layout>