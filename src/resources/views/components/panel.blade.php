@php
    $classes = 'p-4 bg-white/5 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300 flex flex-col'; // Added 'flex flex-col' here
@endphp
<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>
