<x-panel class="flex gap-x-6">
    <div class="flex flex-1 gap-x-6 p-4" style="min-height: 150px;"> <!-- Set a minimum height -->
        <div class="flex items-center">
            <x-employer-logo :employer="$employer" width="80" class="employer-card-logo" />
        </div>

        <div class="flex-1 flex flex-col">
            <h3 class="font-bold text-xl mt-1">{{ $employer->name }}</h3>

            @if($employer->description)
                <p class="text-sm text-gray-400 mt-2">{{ Str::limit($employer->description, 500) }}</p>
            @else
                <p class="text-sm text-gray-400 mt-2">No description available.</p>
            @endif
        </div>

        <div class="flex flex-wrap">
            <!-- Additional employer data can be added here -->
        </div>
    </div>
</x-panel>
