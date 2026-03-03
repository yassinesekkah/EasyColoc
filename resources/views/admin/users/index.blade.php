<x-app-layout>
<div class="max-w-6xl mx-auto py-8 px-6">

    <h1 class="text-2xl font-bold mb-6">All Users</h1>

    <table class="w-full border rounded-lg overflow-hidden">
        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-center">Reputation</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($users as $user)
                <tr>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3 text-center">{{ $user->reputation }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($user->is_banned)
                            <span class="text-red-600 font-bold">Banned</span>
                        @else
                            <span class="text-green-600 font-bold">Active</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <form method="POST" action="{{ route('admin.toggleBan', $user) }}">
                            @csrf
                            @method('PATCH')

                            <button class="px-3 py-1 text-xs rounded 
                                {{ $user->is_banned ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                {{ $user->is_banned ? 'Unban' : 'Ban' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</x-app-layout>