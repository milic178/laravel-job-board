@props(['job'])
<x-panel class="flex gap-x-6">
    <a href="/jobs/{{$job->id}}" target="_blank" class="flex flex-1 gap-x-6 p-4">
        <div>
            <x-employer-logo :employer="$job->employer"></x-employer-logo>
        </div>

        <div class="flex-1 flex flex-col">
            <span class="self-start text-sm text-gray-400">{{$job->employer->name}}</span>
            <h3 class="font-bold text-xl mt-3">
                {{$job->title}}
            </h3>
            <p class="text-sm text-gray-400 mt-auto">Job salary from: {{$job->salary}}</p>
        </div>

        <div class="flex flex-wrap">
            @foreach($job->tags as $tag)
                <x-tag :$tag></x-tag>
            @endforeach
        </div>
    </a>
</x-panel>
