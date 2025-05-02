@props(['img', 'imgAlt', 'title', 'description', 'salary', 'job', 'type'])

<div class="flex flex-col items-center max-h-[45vh] text-center border rounded-xl bg-gray-900 px-2 hover:scale-105 item">
    <div class="text-m text-white py-2">
        {{ App\Models\User::find($job->user_id)->company_name }}
    </div>
    <img class="rounded-lg h-[40%] w-[100%]" src="{{ $img }}" alt="{{ $imgAlt }}" />
    <div class="mt-1">
        <a class="text-sm font-bold text-sky-500 hover:underline block">
            {{ $title }}
        </a>
        <div class="mt-1 text-xs text-gray-200 overflow-hidden line-clamp-2">
            {{ $description }}
        </div>
        <div class="mt-1 text-xs font-bold text-gray-300">
            ${{ $salary }} USD per month
        </div>
        <div class=" mx-auto grid grid-cols-4 gap-3 ">
            @if(!($type == ''))
                <x-tech>{{ $type }}</x-tech>
            @endif
        </div>
        @if(!(request()->routeIs('dashboard')))
            @can('update', $job)
                <div class="flex mx-[15%] justify-start items-center !mt-1 ">
                    <x-primary-button :xtype="'a'" href="{{ route('job.edit', ['job' => $job]) }}"
                        class="!mx-4 !bg-blue-500 !text-white">Edit</x-primary-button>
                    <form action="{{ route('job.destroy', ['job' => $job]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <x-primary-button type="submit" class="!mx-4 !bg-red-500 !text-white">Delete</x-primary-button>
                    </form>
                </div>
            @endcan
        @else
            <div class="pt-1">
                <x-primary-button :xtype="'a'" href="{{ route('viewJob', [$job]) }}" class="!mx-4">View</x-primary-button>
                <x-primary-button class="!mx-4">Apply</x-primary-button>
            </div>
        @endif
    </div>
</div>