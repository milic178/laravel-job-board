<x-layout>
    @props(['job'])

    <div class="bg-white/5 rounded-xl p-6 shadow-md text-gray-400 mx-auto max-w-4xl">
        <div class="flex flex-col items-center mb-4">
            <x-employer-logo :employer="$job->employer" width="100" class="mb-2 mt-1" />
            <h1 class="text-2xl font-bold text-white text-center mb-4 mt-6">{{ $job->title }}</h1>
        </div>

        <div class="flex justify-between gap-8 mb-4 ">
            <div class="flex-1">
                <p class="mb-2"><strong>Salary:</strong> {{ $job->salary }}</p>
                <p class="mb-2"><strong>Location:</strong> {{ $job->location }}</p>
            </div>

            <div class="flex-1 text-right">
                <p class="mb-2"><strong>Schedule:</strong> {{ $job->schedule }}</p>
                <p class="mb-4"><strong>URL:</strong>
                    <a href="{{ $job->url }}" target="_blank" class="text-blue-500">{{ $job->url }}</a>
                </p>
            </div>
        </div>

        <div class="mt-4">
            <strong>Description:</strong>
            <p class="mt-2 break-words max-w-full" style="max-height: 200px; overflow-y: auto;">
                {{ $job->description }}
            </p>
        </div>

        <div class="flex flex-wrap mt-4">
            @foreach($job->tags as $tag)
                <x-tag :$tag></x-tag>
            @endforeach
        </div>
    </div>

    @can('edit', $job)
        <p class="mt-6">
            <button href="/jobs/{{ $job->id }}/edit" class="text-blue-500">Edit Job</button>
        </p>
    @endcan
</x-layout>
