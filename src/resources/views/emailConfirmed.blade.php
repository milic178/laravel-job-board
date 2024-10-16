<x-layout>
    <div class="flex items-start justify-center h-screen mt-20">
        <div class="bg-white text-black p-6 rounded-lg shadow-lg text-center">
            @if(isset($error))
                <p class="text-lg font-semibold text-red-600">{{ $error }}</p>
            @else
                <p class="text-lg font-semibold">Thank you for confirming your email. You will be redirected to Login page in few seconds.</p>
            @endif
        </div>
    </div>

    <script>
        // Redirect after 5 seconds
        setTimeout(() => {
            window.location.href = '/login';
        }, 5000);
    </script>
</x-layout>
