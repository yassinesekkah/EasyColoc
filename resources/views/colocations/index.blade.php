<x-app-layout>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif

    @if ($activeColocation)
        @include('colocations.partials.dashboard')

    @elseif($pastColocations->isNotEmpty())
        @include('colocations.partials.history')
        
    @else
        @include('colocations.partials.empty-state')
    @endif

</x-app-layout>
