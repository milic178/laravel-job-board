<x-layout>
    <x-slot:heading>Job</x-slot:heading>
    <h1>Currently listed</h1>
    <div class="font-bold text-blue-500 text-sm mt-2">{{ $job->employer->name }}</div>
    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>
        This job pays {{ $job->salary }}: per year.
    </p>
    <div class="mt-5">
        <a href="{{ url()->previous() }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow ">Go Back</a>
    </div>

    @can('edit', $job)
    <p class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </p>
    @endcan
</x-layout>

