<x-navigation>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 rounded-md bg-green-100 text-green-800 border border-green-300" id='success'>
            {{ session('success') }}
        </div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-6 py-4 bg-gray-800 ">
        @foreach ($jobs as $job)
            {{-- @dd($job) --}}
            <x-job :img="$job->imageUrl" :imgAlt="$job->title" :title="$job->title" :description="$job->description"
                :salary="$job->salary" :job="$job" :type="$job->tags_id"/>
        @endforeach
    </div>
</x-navigation>