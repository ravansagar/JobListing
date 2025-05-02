<x-navigation>
    <x-info :job="count($jobs)" :category="$tagC" />
    <div id="jobs" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-6 py-4 bg-gray-800">
        @foreach ($jobs as $job)
            <x-job :img="$job->imageUrl" :imgAlt="$job->title" :title="$job->title" :description="$job->description"
                :salary="$job->salary" :job="$job" :techstacks="$job->technologyStacks" :type="$job->tags_id" />
        @endforeach
    </div>
    <div id="pagination" class="flex mx-auto justify-end py-4 !px-6"></div>

    

    <script>
        const itemsPerPage = 8;
        const items = document.querySelectorAll('.item');
        const pagination = document.getElementById('pagination');
        const totalPages = Math.ceil(items.length / itemsPerPage);

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? 'block' : 'none';
            });
        }

        function createPagination() {
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = 'mx-1 px-4 py-2 bg-blue-500 text-white rounded transition-all duration-200 hover:bg-violet-600 focus:outline-2 focus:outline-offset-2 focus:outline-gray-500 active:bg-gray-500';
                btn.addEventListener('click', () => showPage(i));
                pagination.appendChild(btn);
            }
        }

        createPagination();
        showPage(1);
    </script>
</x-navigation>