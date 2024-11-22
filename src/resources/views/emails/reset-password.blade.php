<!-- resources/views/emails/reset-password.blade.php -->
<x-email-layout>
    <x-slot name="header">
        {{ $title }}
    </x-slot>

    <p>{{ $greeting }}</p>
    <p>{{ $messageContent }}</p>

    <p style="text-align: center;">
        <a href="{{ $actionUrl }}" class="button">
            {{ $actionText }}
        </a>
    </p>


    <p>{{ $closingText }}</p>

    <x-slot name="subcopy">
        {{ $subcopy }}
    </x-slot>
</x-email-layout>
