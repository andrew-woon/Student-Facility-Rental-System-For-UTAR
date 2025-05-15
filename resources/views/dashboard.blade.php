<x-app-layout>
    <x-slot name="header">
        {{ __('Welcome Back, ') . Auth::user()->name }}
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 min-h-screen">
        @can('isAdmin')
            <!-- Admin Dashboard -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Manage Users</h3>
                    <p class="my-2 text-sm">You can add, edit or delete users here.</p>
                    <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">Go to Users Management</a>
                </div>

                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Schedules Management</h3>
                    <p class="my-2 text-sm">Approve or reject schedule requests for facilities.</p>
                    <a href="{{ route('schedules.index') }}" class="text-blue-600 hover:underline">Go to Schedule Management</a>
                </div>

                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Facilities Management</h3>
                    <p class="my-2 text-sm">Manage meeting facilities and schedule availability.</p>
                    <a href="{{ route('facilities.index') }}" class="text-blue-600 hover:underline">Go to Facilities Management</a>
                </div>
            </div>
        @endcan
        @can('isUser')
            <!-- User Dashboard -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">My Profile</h3>
                    <p class="my-2 text-sm">Manage your personal information and settings.</p>
                    <a href="{{ route('users.profile') }}" class="text-blue-600 hover:underline">Edit Profile</a>
                </div>

                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">My Facility Schedules</h3>
                    <p class="my-2 text-sm">View, create, or edit your scheduled facilities.</p>
                    <a href="{{ route('users.show', Auth::user()) }}" class="text-blue-600 hover:underline">Go to My Schedules</a>
                </div>

                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Facility Availability</h3>
                    <p class="my-2 text-sm">Check facility availability and book for your intentions.</p>
                    <a href="{{ route('facilities.index') }}" class="text-blue-600 hover:underline">Check Facilities</a>
                </div>
            </div>
        @endcan
    </div>
</x-app-layout>
