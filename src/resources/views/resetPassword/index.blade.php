<x-layout>
    <x-page-heading>Reset Password</x-page-heading>
    <div class="max-w-md mx-auto space-y-4">
        <span class="text-white">
            Forgot your password? No worries! Simply provide us with your email address, and we’ll send you a link to reset your password. You’ll be able to select a new one in just a few easy steps.
        </span>

        <!-- Display the status message -->
        @if(session('status'))
            <div class="bg-green-700 text-white p-2 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-700 text-white p-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <x-forms.form method="POST" action="/password/email" class="space-y-4">
            @csrf
            <x-forms.input label="Email" name="email" type="email" />

            <x-forms.recaptcha position="center" theme="dark" />

            <div class="flex justify-center">
                <x-forms.button>Email Password Reset Link</x-forms.button>
            </div>
        </x-forms.form>


    </div>
</x-layout>
