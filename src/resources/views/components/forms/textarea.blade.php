@props(['label', 'name'])
@php
    $defaults = [
        'type' => 'textarea',
        'id' => $name,
        'name' => $name,
        'rows' => 5,
        'value' => old($name),
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full'
    ];
@endphp
<x-forms.field :$label :$name>
    <div class="mt-1">
        <textarea {{ $attributes($defaults) }}>{{ old($name) }}</textarea>
    </div>
</x-forms.field>
