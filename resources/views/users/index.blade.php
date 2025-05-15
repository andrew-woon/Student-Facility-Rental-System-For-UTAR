<x-app-layout>
    <x-slot name="header">
        {{ __('Manage Users') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('dashboard') }}">Back to Dashboard</a>
            </x-button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <form action="{{ route('users.index') }}" method="GET" class="flex justify-center">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search users..." class="px-4 py-2 border border-gray-300 rounded-md">
                            <button type="submit" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded">Search</button>
                        </form>

                        <x-button class="text-white hover:bg-blue-700">
                            <a href="{{ route('users.create') }}">Create User</a>
                        </x-button>
                    </div>

                    <table class="mt-4 w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $user->role }}</td>
                                    <td class="border px-4 py-2 flex justify-center space-x-2">
                                        @if (auth()->id() === $user->id)
                                            {{-- Show only Profile for current admin --}}
                                            <x-button class="px-4 py-2 text-white hover:bg-blue-700">
                                                <a href="{{ route('users.profile') }}">Profile</a>
                                            </x-button>
                                        @else
                                            {{-- Admin managing other users --}}
                                            <x-button class="px-4 py-2 text-white hover:bg-blue-700">
                                                <a href="{{ route('users.show', $user) }}">View</a>
                                            </x-button>
                                            <x-button class="px-4 py-2 bg-yellow-500 text-white hover:bg-yellow-700">
                                                <a href="{{ route('users.edit', $user) }}">Edit</a>
                                            </x-button>
                                            <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="button" onclick="confirmUserDeletion({{ $user->id }})" class="px-4 py-2 bg-red-500 text-white hover:bg-red-700">Delete</x-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-2">
                            <x-label for="page" class="text-sm">Go to page:</x-label>
                            <x-input type="number" name="page" id="page" min="1" max="{{ $users->lastPage() }}" class="w-20 px-2 py-1 border rounded"/>
                            <x-button class="text-white hover:bg-blue-700">Go</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function confirmUserDeletion(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById('delete-user-' + id).submit();
        }
    }
</script>