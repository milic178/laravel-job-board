@props(['job'])
<x-panel class="flex gap-x-6">
    <div>
        <x-employer-logo></x-employer-logo>
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400">{{$job->employer->name}}</a>
        <h3 class="font-bold text-xl mt-3">{{$job->title}}</h3>
        <p class="text-sm text-gray-400 mt-auto">Job salary from: {{$job->salaray}}</p>
    </div>


    <div>

        @foreach($job->tags as $tag)
            <x-tag :$tag></x-tag>
        @endforeach
    </div>


</x-panel>
