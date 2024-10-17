@php use Illuminate\Support\Str; @endphp
@props(['employer', 'width'=>90])

@php
    $logo = $employer->logo;
    if(!isset($logo)){
        $logo = "http://picsum.photos/seed/".rand(0,10000).'/'.$width.'/'.$width;
    }

    if (Str::startsWith($logo, 'logos/')) {
        $logo = asset('storage/'.$employer->logo);
    }
@endphp

<img src="{{$logo}}" alt="" width="{{$width}}" class="rounded-xl">

