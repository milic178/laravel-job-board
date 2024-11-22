<x-layout>
    <x-page-heading>Register</x-page-heading>
    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        @csrf
        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <small class="text-gray-300">NOTE: Password must be at least 8 characters long</small>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <x-forms.divider />

        <x-forms.input label="Employer Name" name="employer" />
        <x-forms.textarea label="Employer Description" name="description"/>
        <x-forms.input label="Employer Logo" name="logo" type="file" />

        <div class="flex flex-col items-center space-y-4">
            <x-forms.recaptcha position="center" theme="dark" />
            <x-forms.button>Create Account</x-forms.button>
        </div>

    </x-forms.form>
</x-layout>
