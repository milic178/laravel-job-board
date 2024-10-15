@props(['tag', 'size' => 'base'])

@php
    $classes = "bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300";

    if ($size === 'base') {
        $classes .= " px-6 py-2 text-sm"; // Padding for base size
    }

    if ($size === 'small') {
        $classes .= " px-4 py-1 text-xs"; // Padding for small size
    }
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $classes }} mr-1 mb-1">{{ ucwords($tag->name) }}</a> <!-- Reduced margin for small tags -->
