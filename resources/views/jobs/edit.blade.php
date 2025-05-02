<x-navigation>

    <form action="{{ route('job.update', $job) }}" method="POST"
        class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md space-y-6 !bg-gray-900 z-80 my-8">
        <div class="flex justify-between items-center text-3xl text-blue-400 font-bold">
            <div class="w-1/6 flex items-center justify-start">
                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center justify-center w-10 h-10 !pb-1 border border-white rounded-full text-white hover:bg-white hover:text-black transition-all duration-300 ease-in-out">
                    &#8592;
                </a>
            </div>

            <div class="w-2/3 text-center">
                Job Information
            </div>

            <div class="w-1/6"></div>
        </div>
        @csrf
        @method('PATCH')

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
            <x-inputbox :for="'title'" :label="'Job Title'" :type="'text'" :name="'title'" :value="$job->title" />
            <x-inputbox :for="'salary'" :label="'Job Salary ($USD)'" :type="'number'" :name="'salary'"
                :value="$job->salary" />
        </div>

        <x-inputbox :for="'imageUrl'" :label="'Job Image Url'" :type="'text'" :name="'imageUrl'"
            :value="$job->imageUrl" />

        <div class="w-full max-w-3xl mx-auto">
            <label for="tag_id" class="block text-sm font-medium text-blue-500 mb-1">Select Job Type</label>
            <select name="tag_id" id="tag_id"
                class="block w-full bg-gray-700 text-white rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                @foreach ($types as $type)
                    @if($type->id == $job->tags_id)
                        <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                    @else
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endif
                @endforeach
                <option value="add_new_type" class="text-yellow-400">+ Add JobType</option>
            </select>

            <div id="addTypeForm" class="mt-3 hidden">
                <div id="addTypeAjaxForm" class="flex items-center gap-4">
                    <input name="newTypeName" type="text" id="newTypeName" class="rounded-md p-2 w-full text-white"
                        placeholder="Enter new job type..." required>
                    <button type="button" id="submitNewType"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md">Add</button>
                </div>
                <div id="typeAddMsg" class="text-sm text-green-400 mt-2 hidden"></div>
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-blue-500 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border text-white border-gray-300 h-18 rounded-lg p-2 focus:ring focus:ring-blue-300"
                required>{{ $job->description }}</textarea>
            @error('description')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">
                Update Job
            </button>
        </div>
    </form>

</x-navigation>

<script>
    document.getElementById('tag_id').addEventListener('change', function() {
        const addForm = document.getElementById('addTypeForm');
        const newTypeInput = document.getElementById('newTypeName');
        if (this.value === 'add_new_type') {
            addForm.classList.remove('hidden');
            newTypeInput.setAttribute('required', 'required');
        } else {
            addForm.classList.add('hidden');
            newTypeInput.removeAttribute('required');
        }
    });
     document.getElementById('tag_id').addEventListener('change', function () {
        const addForm = document.getElementById('addTypeForm');
        const newTypeInput = document.getElementById('newTypeName');
        if (this.value === 'add_new_type') {
            addForm.classList.remove('hidden');
        } else {
            addForm.classList.add('hidden');
        }
        
    });

    document.getElementById('submitNewType').addEventListener('click', function () {
        const name = document.getElementById('newTypeName').value.trim();
        const msgDiv = document.getElementById('typeAddMsg');
        msgDiv.classList.add('hidden');

        if (!name) {
            msgDiv.textContent = "Please enter a job type name.";
            msgDiv.classList.remove('hidden');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('tags.store') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ name: name })
        })
            .then(async res => {
                const data = await res.json();

                if (!res.ok || !data.success) {
                    throw new Error(data.message || "Request failed.");
                }

                msgDiv.textContent = "Job type added!";
                msgDiv.classList.remove('hidden');

                const select = document.getElementById('tag_id');
                const option = document.createElement('option');
                option.value = data.tag.id;
                option.text = data.tag.name;
                select.insertBefore(option, select.lastElementChild);

                select.value = data.tag.id;
                document.getElementById('newTypeName').value = "";
                document.getElementById('addTypeForm').classList.add('hidden');
            })
            .catch(err => {
                msgDiv.textContent = "Error adding job type.";
                msgDiv.classList.remove('hidden');
                console.error("Fetch error:", err);
            });
    });
</script>