<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <div class="mb-4">
            <a href="{{ route('colocations.index') }}"
                class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">

                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>

                Back to Colocation
            </a>
        </div>
        <h2 class="text-2xl font-bold mb-6">
            All Expenses - {{ $colocation->name }}
        </h2>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Payer</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($expenses as $expense)
                        <tr>
                            <td class="px-6 py-4">{{ $expense->title }}</td>
                            <td class="px-6 py-4">{{ $expense->category->name }}</td>
                            <td class="px-6 py-4">{{ $expense->payer->name }}</td>
                            <td class="px-6 py-4">{{ $expense->date }}</td>
                            <td class="px-6 py-4 text-right font-bold">
                                ${{ number_format($expense->amount, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $expenses->links() }}
        </div>

    </div>
</x-app-layout>
