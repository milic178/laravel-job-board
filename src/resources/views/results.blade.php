<x-layout>
    @php
        $title = 'Results ';

        if(isset($searchString)){
            $title .= 'for: '.$searchString;
        }
    @endphp
    <x-page-heading>{{$title}}</x-page-heading>
    <div>
        @if(empty($jobs))
            <p class="mt-auto text-lg font-semibold text-center">Sorry no results found for your search query :(</p>
        @endif
    </div>

    <div class="space-y-6">
        @foreach($jobs as $job)
            <x-job-card-wide :$job/>
        @endforeach
    </div>

    @if(!empty($jobs))
        {{ $jobs->links() }}
    @endif
</x-layout>
