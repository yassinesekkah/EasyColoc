<div class="min-h-screen bg-gray-50 font-sans antialiased pb-12">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
            <span class="text-xl font-black tracking-tight text-indigo-600">EasyColoc</span>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-gray-900 leading-none">Yassine Karim</p>
                    <p class="text-[10px] text-gray-400 uppercase mt-1">Guest Account</p>
                </div>
                <div class="w-10 h-10 bg-gray-100 rounded-full border-2 border-white shadow-sm flex items-center justify-center text-xs font-bold text-gray-500">
                    YK
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-10">

        <div class="bg-white rounded-[2rem] p-8 md:p-12 text-center shadow-sm border border-gray-100 mb-12">
            <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-black text-gray-900 mb-3">No Active Colocation</h1>
            <p class="text-gray-500 max-w-md mx-auto mb-8 text-sm leading-relaxed">
                You aren't currently registered in any house. You can start a new one or join your roommates if they've already invited you.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button class="w-full sm:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition shadow-lg shadow-indigo-100">
                    Create New Colocation
                </button>
                <button class="w-full sm:w-auto px-8 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition">
                    Join via Invitation
                </button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <h2 class="text-sm font-black uppercase tracking-[0.2em] text-gray-400">Past Colocations</h2>
                <div class="h-px bg-gray-200 flex-1"></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-6 py-4 text-[11px] font-bold uppercase text-gray-400">Colocation Name</th>
                                <th class="px-6 py-4 text-[11px] font-bold uppercase text-gray-400 text-center">Role</th>
                                <th class="px-6 py-4 text-[11px] font-bold uppercase text-gray-400">Duration</th>
                                <th class="px-6 py-4 text-[11px] font-bold uppercase text-gray-400">Status</th>
                                <th class="px-6 py-4 text-[11px] font-bold uppercase text-gray-400 text-right">Final Balance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($pastColocations as $colocation)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-5">
                                    <span class="text-sm font-bold text-gray-800">{{ $colocation->name }}</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider {{ $colocation->pivot->role === 'Owner' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                                        {{ $colocation->pivot->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-xs text-gray-500 font-medium">
                                        <div class="flex items-center gap-1">
                                            <span class="text-gray-400">In:</span> {{ $colocation->pivot->created_at }}
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="text-gray-400">Out:</span> {{ $colocation->pivot->left_at }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                        {{ $colocation->status }} </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="text-sm font-black {{ $colocation->pivot->final_balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $colocation->pivot->final_balance >= 0 ? '+' : '' }}{{ $colocation->pivot->final_balance }} DH
                                    </span>
                                </td>
                            </tr>
                            @endforeach

                            @if($pastColocations->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="text-sm font-medium text-gray-400 italic">No historical records found.</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-12 p-6 bg-indigo-50/50 rounded-2xl border border-indigo-100 flex items-start gap-4">
            <div class="text-indigo-600 mt-0.5">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-indigo-900">Archived Access</h4>
                <p class="text-xs text-indigo-700 leading-relaxed mt-1">
                    Your history is kept for 24 months after leaving a colocation. You can still download individual expense reports for tax or personal records by clicking on a row.
                </p>
            </div>
        </div>

    </main>
</div>