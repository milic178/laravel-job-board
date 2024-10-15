@props(['label', 'name', 'value' => false])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => 1, // Set the value to '1' for the checkbox
    ];

    // Check if the checkbox should be checked
    if (old($name, $value)) {
        $defaults['checked'] = 'checked'; // Add the checked attribute if true
    }
@endphp

<x-forms.field :$label :$name>
    <div class="rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full flex items-center">
        <input {{ $attributes($defaults) }}>
        <span class="pl-1">{{ $label }}</span>
    </div>
</x-forms.field>
