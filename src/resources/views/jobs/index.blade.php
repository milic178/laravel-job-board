<x-layout>
    <div class="space-y-10">
        <section class="text-center">
            <h1 class="font-bold text-4xl">Lets Find Your Next Job</h1>
            <form action="" class="mt-6">
                <input type="text" placeholder="Web Developer..."
                       class="rounded-xl bg-white/5 border-white/10 px-5 py-4 w-full max-w-xl">
            </form>
        </section>
        <section class="pt-10">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($featuredJobs as $job)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-job-card :$job></x-job-card>
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 space-x-1">
                @foreach($tags as $tag)
                    <!--name and parameter are the same thus  use :$ -->
                    <x-tag :$tag></x-tag>
                @endforeach
            </div>
        </section>

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
