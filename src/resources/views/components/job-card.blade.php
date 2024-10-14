<x-panel class="text-center">
    <a href="/jobs/{{$job->id}}" target="_blank" class="flex flex-col flex-1 h-full">
        <div class="self-start text-sm">{{$job->employer->name}}</div>
        <div class="py-8 flex-1">
            <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors duration-900">
                {{$job->title}}
            </h3>
            <p class="text-sm mt-4">Job salary: {{$job->salary}}</p>
        </div>
    </a>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach($job->tags as $tag)
                <x-tag size="small" :$tag></x-tag>
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" width="42"></x-employer-logo>
    </div>
</x-panel>
