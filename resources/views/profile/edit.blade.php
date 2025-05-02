<x-navigation>
    @if(session('success'))
        <div class="mb-4 px-4 py-2 rounded-md bg-green-100 text-green-800 border border-green-300" id='success'>
            {{ session('success') }}
            <button onclick="window.location.reload()" class="text-xl font-bold mx-4">x</button>
        </div>
    @endif
    @if(session('failiure'))
        <div class="mb-4 px-4 py-2 rounded-md bg-red-100 text-red-800 border border-red-300 flex justify-between" id='failiure'>
            {{ session('failiure') }} 
            <button onclick="window.location.reload()" class="text-xl font-bold mx-4">x</button>
        </div>
    @endif
    <div class="flex h-[88vh] justify-center items-center">
        <div id="profile-info" class="">
            <div class="bg-black p-4 text-white text-center w-[50vw]">
                <img src="https://www.vianet.com.np/wp-content/uploads/2021/03/vianet-log-black-bg-red.png" alt=""
                    class="h-20 w-20 object-fill w-auto rounded-lg">
                <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
                <div class="p-6 text-left rounded">
                    <div class="mb-4 flex justify-between">
                        <div class="font-semibold">Email:</div>
                        <div class="text-right">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="mb-4 flex justify-between">
                        <div class="font-semibold">Company's Name:</div>
                        <div class="text-right">{{ Auth::user()->company_name }}</div>
                    </div>
                    <div class="mb-6 flex justify-between">
                        <div class="font-semibold">Company's Address:</div>
                        <div class="text-right">{{ Auth::user()->company_location }}</div>
                    </div>
                    <hr>
                </div>
                <div class="gap-4 my-4 mx-4">
                    <x-primary-button :type="'button'" onclick="editProfile()" class="mx-4">Update
                        Profile</x-primary-button>
                    <x-primary-button :type="'button'" onclick="updatePassword()" class="mx-4">Update
                        Password</x-primary-button>
                    <x-primary-button :type="'button'" onclick="deleteProfile()" class="!bg-red-500 mx-4">Delete
                        Account</x-primary-button>
                </div>
            </div> 
        </div>
        <div id="edit" class="p-4 sm:p-8 w-[50vw] bg-white dark:bg-black shadow sm:rounded-lg hidden">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div id="update-password" class="p-4 w-[50vw] sm:p-8 bg-white dark:bg-black shadow sm:rounded-lg hidden">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div id="delete-profile" class="p-4 w-[50vw] sm:p-8 bg-white dark:bg-black shadow sm:rounded-lg hidden">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-navigation>

<script>
    function editProfile() {
        document.getElementById('profile-info').classList.add('hidden');
        if (!(document.getElementById('update-password').classList.contains('hidden')) || !(document.getElementById('delete-profile').classList.contains('hidden')))
            hideAllForms();

        document.getElementById('edit').classList.toggle('hidden');
    }

    function updatePassword() {
        document.getElementById('profile-info').classList.add('hidden');

        if (!(document.getElementById('edit').classList.contains('hidden')) || !(document.getElementById('delete-profile').classList.contains('hidden'))) {
            hideAllForms();
        }

        document.getElementById('update-password').classList.toggle('hidden');
    }

    function deleteProfile() {
        document.getElementById('profile-info').classList.add('hidden');

        if (!(document.getElementById('edit').classList.contains('update-password')) || !(document.getElementById('update_password').classList.contains('hidden')))
            hideAllForms();
        document.getElementById('delete-profile').classList.toggle('hidden');
    }

    function hideAllForms() {
        document.getElementById('edit').classList.add('hidden');
        document.getElementById('update-password').classList.add('hidden');
        document.getElementById('delete-profile').classList.add('hidden');
    }
</script>


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}