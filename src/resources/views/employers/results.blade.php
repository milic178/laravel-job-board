<x-layout>
    @php
        $title = 'Results ';

        if(isset($searchString)){
            $title .= 'for: '.$searchString;
        }
    @endphp
    <x-page-heading>{{$title}}</x-page-heading>
    <div class="space-y-6">
        @foreach($employers as $employer)
            <x-employer-card-wide :$employer/>
        @endforeach
    </div>

    @if(!empty($employers))
        {{ $employers->links() }}
    @endif

</x-layout>
