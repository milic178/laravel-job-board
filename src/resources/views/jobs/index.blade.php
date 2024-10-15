<x-layout>
    <div class="space-y-10">
        <!-- Search job form -->
        <section class="text-center">
            <h1 class="font-bold text-4xl">Lets Find Your Next Job</h1>
            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." type="text"/>
            </x-forms.form>
        </section>

        <!-- Featured jobs -->
        <section class="pt-10">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($featuredJobs as $job)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-job-card :$job></x-job-card>
                @endforeach
            </div>
        </section>

        <!-- Tags -->
        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <x-tag :$tag></x-tag>
                @endforeach
            </div>
        </section>

        <!-- Recent jobs -->
        <section>
            <x-section-heading>Recent Jobs</x-section-heading>
            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-job-card-wide :$job></x-job-card-wide>
                @endforeach

            </div>
        </section>
    </div>

</x-layout>
