<x-app-layout>
    <x-slot name="header">
        {{ $user->name }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('users.index') }}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-4">Profile Details</h3>
                    <form action="{{ auth()->user()->role === 'admin' ? route('users.update', $user) : route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-label for="name" class="block text-sm font-medium text-gray-700">Name</x-label>
                            <x-input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"  placeholder="Enter name"/>
                            @error('name')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="school_id" class="block text-sm font-medium text-gray-700">School ID</x-label>
                            <x-input type="text" name="school_id" id="school_id" value="{{ old('school_id', $user->school_id) }}" placeholder="Enter school ID/>
                            @error('school_id')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="email" class="block text-sm font-medium text-gray-700">Email</x-label>
                            <x-input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Enter email"/>
                            @error('email')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" class="block text-sm font-medium text-gray-700">Phone</x-label>
                            <x-input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone contact"/>
                            @error('phone')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-button class="text-white font-semibold rounded hover:bg-blue-700 transition">
                                {{ __('Update Profile') }}
                            </x-button>
                        </div>
                    </form>

                    <hr class="my-6 border-t border-gray-300">
                    <h3 class="text-lg font-medium mb-4">Change Password</h3>
                    <form method="POST" action="{{ route('profile.updatePassword') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</x-label>
                            <x-input type="password" name="current_password" id="current_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"/>
                            @error('current_password')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="password" class="block text-sm font-medium text-gray-700">New Password</x-label>
                            <x-input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"/>
                            @error('password')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</x-label>
                            <x-input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"/>
                            @error('password_confirmation')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <x-button class="px-4 py-2 bg-yellow-500 text-white hover:bg-yellow-700">
                            {{ __('Update Password') }}
                        </x-button>
                    </form>

                    <hr class="my-6 border-t border-gray-300">
                    <h3 class="text-lg font-medium mb-4">Delete Account</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Deleting your account is permanent and cannot be undone. All of your data, including your personal information, schedules, and other associated content, will be lost. If you're sure about deleting your account, please proceed by clicking the button below.
                    </p>

                    <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <x-button type="button" onclick="confirmDeletion()" class="px-4 py-2 bg-red-500 text-white hover:bg-red-700">Delete Account</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmAccountDeletion() {
        if (confirm("Are you sure you want to delete your account? This is permanent and cannot be undone.")) {
            document.getElementById('delete-account-form').submit();
        }
    }
</script>