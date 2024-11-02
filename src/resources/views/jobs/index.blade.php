<x-layout>
    <div class="space-y-10">
        <!-- Search job form -->
        <section class="text-center mb-4">
            @if(session('status'))
                <div class="bg-green-700 text-white p-2 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="font-bold text-4xl">Lets Find Your Next Job</h1>
            <x-forms.form action="/searchAll" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." type="text"/>
            </x-forms.form>
        </section>

        <!-- Featured jobs -->
        <section class="pt-2">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-4 gap-6 mt-4">
                @foreach($featuredJobs as $job)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-job-card :$job></x-job-card>
                @endforeach
            </div>

            <!-- 'View More Jobs' link to scroll to recent jobs -->
            <div class="text-center mt-10">
                <a href="#recent-jobs" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
                    View All Recent Jobs
                </a>
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
        <section id="recent-jobs">
            <x-section-heading>Recent Jobs</x-section-heading>
            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-job-card-wide :$job></x-job-card-wide>
                @endforeach

            </div>
        </section>
        <div>
            {{ $jobs->links() }}
        </div>
    </div>

</x-layout>
