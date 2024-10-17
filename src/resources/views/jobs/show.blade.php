<x-layout>
    @props(['job'])

    <div class="bg-white/5 rounded-xl p-6 shadow-md text-gray-400 mx-auto max-w-4xl relative">
        <div class="flex justify-end mb-2"> <!-- Reduced margin-bottom -->
            @can('edit', $job)
                <div class="flex gap-4">
                    <a href="/jobs/{{ $job->id }}/edit" class="text-blue-500">Edit Job</a>
                    <form action="/jobs/{{ $job->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete Job</button>
                    </form>
                </div>
            @endcan
        </div>

        <div class="flex flex-col items-center mb-4">
            <x-employer-logo :employer="$job->employer" width="60" class="mb-1 mt-1" /> <!-- Reduced margin-bottom -->
            <h1 class="text-2xl font-bold text-white text-center mt-3">{{ $job->title }}</h1>
        </div>

        <x-forms.divider />

        <div class="flex justify-between gap-8 mb-4">
            <div class="flex-1">
                <p class="mb-2"><strong class="text-white">Salary:</strong> {{ $job->salary }}</p>
                <p class="mb-2"><strong class="text-white">Location:</strong> {{ $job->location }}</p>
            </div>

            <div class="flex-1 text-right">
                <p class="mb-2"><strong class="text-white">Schedule:</strong> {{ $job->schedule }}</p>
                <p class="mb-4"><strong class="text-white">URL:</strong>
                    <a href="{{ $job->url }}" target="_blank" class="text-blue-500">{{ $job->url }}</a>
                </p>
            </div>
        </div>

        <x-forms.divider />

        <div class="mt-4">
            <strong class="text-white">Description:</strong>
            <p class="mt-2 break-words max-w-full" style=" overflow-y: auto;">
                {!! nl2br(e($job->description)) !!}
            </p>
        </div>

        <div class="flex flex-wrap mt-6 text-white">
            @foreach($job->tags as $tag)
                <x-tag :$tag></x-tag>
            @endforeach
        </div>

    </div>
</x-layout>
