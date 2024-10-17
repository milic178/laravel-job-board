<x-layout>
    <div class="space-y-10">
        <section class="text-center">
            <h1 class="font-bold text-4xl">Search For Employers</h1>
            <!-- todo prevent form submission if search query is less than 3 chars -->
            <x-forms.form action="/searchEmployer" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Wiegand Inc..." type="text"/>
            </x-forms.form>
        </section>

        <!-- Most Recent Employers -->
        <section class="pt-10">
            <x-section-heading>Most Recent Employers</x-section-heading>
            <div class="flex flex-col space-y-6 mt-6">
                @foreach($recentEmployers as $employer)
                    <x-employer-card-wide :employer="$employer"></x-employer-card-wide>
                @endforeach
            </div>
        </section>

        <!-- All Employers -->
        <section>
            <x-section-heading>All Employers</x-section-heading>
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($allEmployers as $employer)
                    <x-employer-card-wide :employer="$employer"></x-employer-card-wide>
                @endforeach
            </div>
        </section>

        {{ $allEmployers->links() }}
    </div>
</x-layout>
