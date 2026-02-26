<div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">
    <div class="min-h-screen bg-gray-50 font-sans antialiased">

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">The Sunny Loft</h1>
                            <div class="flex items-center mt-1 space-x-3">
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Owner</span>
                                <span class="text-sm text-gray-500">Reputation: <span
                                        class="font-bold text-gray-700">98%</span></span>
                            </div>
                        </div>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-indigo-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Expense
                        </button>
                    </div>
                </div>

                {{-- @if ($userIsOwner) --}}
                <div class="flex flex-wrap gap-3">
                    <button @click="open = true"
                        class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition">Invite
                        Member</button>
                    <button
                        class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition">Manage
                        Categories</button>
                    <form method="POST" action="{{ route('colocations.leave', $activeColocation) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-4 py-2 bg-red-50 border border-red-100 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition">Cancel
                            Colocation</button>
                    </form>
                </div>
                {{-- @endif --}}
            </div>

            @if (session('invite_link'))
                <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <p class="text-sm text-green-700 mb-2">
                        Invitation link generated:
                    </p>

                    <div class="flex items-center gap-2">
                        <input type="text" value="{{ session('invite_link') }}" readonly
                            class="w-full px-3 py-2 text-sm border rounded-lg bg-white">

                        <button onclick="navigator.clipboard.writeText('{{ session('invite_link') }}')"
                            class="px-3 py-2 bg-green-600 text-white text-sm rounded-lg">
                            Copy
                        </button>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Paid</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">$1,240.00</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Total Owed</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">$450.00</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Current Balance</p>
                    <p class="text-3xl font-bold mt-1 text-green-600">+$790.00</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50">
                            <h3 class="font-bold text-gray-900">Settlements</h3>
                        </div>
                        <ul class="divide-y divide-gray-50">
                            <li class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="text-sm">
                                            <p class="font-semibold text-gray-900 leading-none">Sarah Miller</p>
                                            <p class="text-xs text-gray-500 mt-1">owes you</p>
                                        </div>
                                    </div>
                                    <span class="text-lg font-bold text-indigo-600">$45.00</span>
                                </div>
                                <button
                                    class="w-full py-2 bg-gray-50 text-indigo-600 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-indigo-600 hover:text-white transition">
                                    Mark as Paid
                                </button>
                            </li>
                            <li class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="text-sm">
                                            <p class="font-semibold text-gray-900 leading-none">You</p>
                                            <p class="text-xs text-gray-500 mt-1">owe Mike Ross</p>
                                        </div>
                                    </div>
                                    <span class="text-lg font-bold text-red-600">$12.50</span>
                                </div>
                                <button
                                    class="w-full py-2 bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-widest rounded-lg cursor-not-allowed"
                                    disabled>
                                    Awaiting Approval
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50">
                            <h3 class="font-bold text-gray-900">Recent Expenses</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">Title</th>
                                        <th class="px-6 py-4">Category</th>
                                        <th class="px-6 py-4">Payer</th>
                                        <th class="px-6 py-4">Date</th>
                                        <th class="px-6 py-4 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">Monthly Internet</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 text-xs bg-blue-50 text-blue-600 rounded-md">Utilities</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">John Doe</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Oct 12, 2023</td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-900">$59.99</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">Cleaning Supplies</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 text-xs bg-green-50 text-green-600 rounded-md">Household</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Sarah Miller</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Oct 10, 2023</td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-900">$22.40</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">Pizza Night</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 text-xs bg-yellow-50 text-yellow-600 rounded-md">Food</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Mike Ross</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Oct 08, 2023</td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-900">$45.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 bg-gray-50 text-center">
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">View
                                all expenses</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('colocations.partials.invite-modal', ['colocation' => $activeColocation])
</div>
