<div class="my-1 w-75 flex justify-center">
    <button onclick="window.location='{{ route('jobsbytag', ['tags' => $slot]) }}'" 
        class="rounded-xl bg-blue-500 text-white py-1 px-2 text-sm">
        {{ App\Models\Tags::find($slot)->name }}
    </button>
</div>
