<x-layout>
    <x-page-heading>New Password</x-page-heading>
    <div class="max-w-md mx-auto space-y-4">
        <span class="text-white">
            To reset your password, please enter a new password below. Make sure your new password is strong and secure, using a mix of letters, numbers, and special characters. Once you submit your new password, you will be able to access your account with the new credentials.
        </span>

        <!-- Display the status message -->
        @if(session('status'))
            <div class="bg-green-700 text-white p-2 rounded">
                {{ session('status') }}
            </div>
        @endif

        <x-forms.form method="POST" action="/password/reset">
            @csrf
            <x-forms.input label="Password" name="password" type="password" />
            <small class="text-gray-300">NOTE: Password must be at least 8 characters long</small>
            <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

            <x-forms.input type="hidden" label="" name="token" value="{{$token}}"/>
            
            <div class="flex flex-col items-center space-y-4">
                <x-forms.recaptcha position="center" theme="dark" />
                <x-forms.button>Reset password</x-forms.button>
            </div>

        </x-forms.form>
    </div>
</x-layout>
