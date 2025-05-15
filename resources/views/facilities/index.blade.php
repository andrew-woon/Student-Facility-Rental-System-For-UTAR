<x-app-layout>
    <x-slot name="header">
        {{ __('Facilities') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('dashboard') }}">Back to Dashboard</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <form action="{{ route('facilities.index') }}" method="GET" class="flex justify-center">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search facilities..." class="px-4 py-2 border border-gray-300 rounded-md">
                            <button type="submit" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded">Search</button>
                        </form>
                        @can('create', App\Models\Facility::class)
                            <x-button class="bg-blue-500 text-white hover:bg-blue-700">
                                <a href="{{ route('facilities.create') }}">Create Facility</a>
                            </x-button>
                        @endcan
                    </div>

                    {{-- Facility List --}}
                    <table class="mt-4 w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">Facility Name</th>
                                <th class="border px-4 py-2">Location</th>
                                <th class="border px-4 py-2">Description</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($facilities as $facility)
                                <tr>
                                    <td class="border px-4 py-2">{{ $facility->name }}</td>
                                    <td class="border px-4 py-2">{{ $facility->location }}</td>
                                    <td class="border px-4 py-2">{{ $facility->description }}</td>
                                    <td class="border px-4 py-2 flex justify-center items-center space-x-2">
                                        <x-button class="px-4 py-2 text-white hover:bg-blue-700">
                                            <a href="{{ route('facilities.show', $facility) }}">View</a>
                                        </x-button>

                                        @can('update', $facility)
                                            <x-button class="px-4 py-2 bg-yellow-500 text-white hover:bg-yellow-700">
                                                <a href="{{ route('facilities.edit', $facility) }}">Edit</a>
                                            </x-button>
                                        @endcan

                                        @can('delete', $facility)
                                        <form id="delete-facility-{{ $facility->id }}" action="{{ route('facilities.destroy', $facility) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="button" onclick="confirmFacilityDeletion({{ $facility->id }})" class="px-4 py-2 bg-red-500 text-white hover:bg-red-700">Delete</x-button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">No facilities found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $facilities->links() }}
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <form method="GET" action="{{ route('facilities.index') }}" class="flex items-center space-x-2">
                            <x-label for="page" class="text-sm">Go to page:</x-label>
                            <x-input type="number" name="page" id="page" min="1" max="{{ $facilities->lastPage() }}" class="w-20 px-2 py-1 border rounded"/>
                            <x-button class="text-white hover:bg-blue-700 ">Go</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function confirmFacilityDeletion(id) {
        if (confirm("Are you sure you want to delete this facility?")) {
            document.getElementById('delete-facility-' + id).submit();
        }
    }
</script>
