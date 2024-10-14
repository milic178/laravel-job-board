<x-layout>
    @php
        $title = 'Results';

        if(isset($searchString)){
            $title .= 'for: '.$searchString;
        }
    @endphp
    <x-page-heading>{{$title}}</x-page-heading>
    <div class="space-y-6">
        @foreach($jobs as $job)
            <x-job-card-wide :$job/>
        @endforeach
    </div>
</x-layout>
