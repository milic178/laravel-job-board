<x-panel class="flex gap-x-6">
    <div class="flex flex-1 gap-x-6 p-4">
        <div class="flex items-center">
            <x-employer-logo :employer="$employer" width="80" class="employer-card-logo" /> <!-- Adjust the size as needed -->
        </div>

        <div class="flex-1 flex flex-col">
            <h3 class="font-bold text-xl mt-1"> <!-- Reduced margin-top -->
                {{ $employer->name }}
            </h3>
            <p class="text-sm text-gray-400 mt-2">{{ Str::limit($employer->description, 500) }}</p> <!-- Added margin-top -->
        </div>

        <div class="flex flex-wrap">
            <!-- todo add more employed data -->
        </div>
    </div>
</x-panel>
