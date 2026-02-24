<x-app-layout>

@if($activeColocation)
    @include('colocations.partials.dashboard')

@elseif($pastColocations->isNotEmpty())
    @include('colocations.partials.history')

@else
    @include('colocations.partials.empty-state')
@endif

</x-app-layout>