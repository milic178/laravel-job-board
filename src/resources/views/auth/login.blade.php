<x-layout>
    <x-page-heading>Login</x-page-heading>
    <x-forms.form method="POST" action="/login">
        @csrf
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />

        <div class="mb-4">
            <x-forms.recaptcha position="center" theme="dark" />
        </div>

        <div class="flex justify-between items-center">
            <a href="/password/reset" class="text-blue-600 text-lg underline">Forgot your password?</a>
            <x-forms.button>Login</x-forms.button>
        </div>

    </x-forms.form>
</x-layout>
