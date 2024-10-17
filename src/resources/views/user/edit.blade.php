<x-layout>
    <x-page-heading>Edit User: {{ $user->name }}</x-page-heading>

    <x-forms.form method="POST" action="/user/{{$user->id}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <x-forms.input label="Name" name="name" value="{{$user->name}}"/>
        <x-forms.input label="Email" name="email" type="email" value="{{$user->email}}" />

        <x-forms.input label="Password" name="password" type="password" />
        <small class="text-gray-300">Leave blank to keep the current password</small>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <x-forms.divider/>

        <x-forms.input label="Employer Name" name="employer_name" value="{{$user->employer->name}}"/>
        <x-forms.textarea label="Employer Description" name="employer_description" :value="$user->employer->description"/>

        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
            <x-forms.input label="Employer Logo" name="employer_logo" type="file" class="sm:w-full" />
            <div class="flex items-center">
                <x-employer-logo :employer="$user->employer" width="60" class="sm:w-auto" />
            </div>
        </div>

        <small class="text-gray-300">Leave blank to keep the current logo</small>

        <!-- Buttons Section -->
        <div class="flex flex-col sm:flex-row justify-between sm:space-x-4 mt-4">
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg text-center mb-2 sm:mb-0 sm:w-auto">
                Back
            </a>

            <!-- Delete and Update Buttons -->
            <div class="flex flex-col sm:flex-row justify-end sm:space-x-4">
                <button type="submit" class="text-red-500 py-2 px-4 rounded-lg font-bold"
                        form="delete-form"
                        onclick="return confirm('Are you sure you want to delete this user?');">
                    Delete User
                </button>

                <x-forms.button>Update</x-forms.button>
            </div>
        </div>
    </x-forms.form>

    <!-- Hidden Delete Form -->
    <form method="POST" action="/user/{{$user->id}}" id="delete-form" class="hidden">
        @method('DELETE')
        @csrf
    </form>
</x-layout>
