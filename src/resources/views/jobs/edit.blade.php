<x-layout>
    <x-page-heading>Edit Job: {{ $job->title }}</x-page-heading>

    <x-forms.form method="POST" action="/jobs/{{$job->id}}">
        @csrf
        @method('PATCH')
        <x-forms.input label="Title" name="title" value="{{$job->title}}"/>
        <x-forms.input label="Salary" name="salary" value="{{$job->salary}}"/>
        <x-forms.input label="Location" name="location" value="{{$job->location}}"/>

        <x-forms.select label="Schedule" name="schedule" :value="$job->schedule">
            <option value="Part Time" {{ $job->schedule == 'Part Time' ? 'selected' : '' }}>Part Time</option>
            <option value="Full Time" {{ $job->schedule == 'Full Time' ? 'selected' : '' }}>Full Time</option>
        </x-forms.select>

        <x-forms.textarea label="Description" name="description" :value="$job->description"/>
        <x-forms.input label="URL" name="url" value="{{$job->url}}"/>
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" :value="$job->featured"/>

        <x-forms.divider/>
        <x-forms.input label="Tags (comma separated)" name="tags" value="{{$job->getTagNamesSeparatedByComma()}}"/>


        <div class="flex justify-between mt-4">
            <x-forms.button>Update</x-forms.button>
            <button type="submit" class="text-red-500 text-lg font-bold"
                    form="delete-form"
                    onclick="return confirm('Are you sure you want to delete this job?');">Delete
            </button>
        </div>
    </x-forms.form>

    <form method="POST" action="/jobs/{{$job->id}}" id="delete-form" class="hidden">
        @method('DELETE')
        @csrf
    </form>
</x-layout>
