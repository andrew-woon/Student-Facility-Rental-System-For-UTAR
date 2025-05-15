<x-app-layout>
    <x-slot name="header">
        {{ __('User Schedule: ' . $user->name) }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                @can('isAdmin')
                <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                    <a href="{{ route('users.index') }}">Back</a>
                </x-button>
                @endcan
                @can('isUser')
                <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                </x-button>
                @endcan
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.show', $user) }}" method="GET" class="flex flex-wrap justify-front gap-3 mb-4">
                        <input type="text" name="facility_search" value="{{ request('facility_search') }}"
                            placeholder="Search facilities..." class="px-4 py-2 border border-gray-300 rounded-md">

                        <input type="date" name="date" value="{{ request('date') }}"
                            min="{{ \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}"
                            max="{{ \Carbon\Carbon::now()->addMonths(3)->format('Y-m-d') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md">

                        <select name="status" class="px-4 py-2 border border-gray-300 rounded-md">
                            <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded">Search</button>
                    </form>

                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Facility</th>
                                <th class="border px-4 py-2">Start Time</th>
                                <th class="border px-4 py-2">End Time</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ $schedule->facility->name ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->start_time->format('Y-m-d H:i') }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->end_time->format('Y-m-d H:i') }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <span class="@if($schedule->status === 'approved') text-green-600 font-semibold 
                                                    @elseif($schedule->status === 'pending') text-yellow-500 font-semibold 
                                                    @elseif($schedule->status === 'rejected') text-red-600 font-semibold 
                                                    @else text-gray-600 @endif">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2 text-center space-x-2">
                                        @can('isAdmin')
                                            <x-button class="px-4 py-2 text-white hover:bg-blue-700">
                                                <a href="{{ route('schedules.show', $schedule) }}">Manage</a>
                                            </x-button>  
                                        @endcan
                                        @can('isUser')
                                            @if ($schedule->status === 'pending')
                                                <x-button class="bg-yellow-500 text-white hover:bg-yellow-700">
                                                    <a href="{{ route('schedules.edit', $schedule) }}">Edit</a>
                                                </x-button>
                                                <form id="delete-schedule-{{ $schedule->id }}" action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="button" onclick="confirmScheduleDeletion({{ $schedule->id }})" class="bg-red-500 text-white hover:bg-red-700">
                                                        Delete
                                                    </x-button>
                                                </form>
                                            @else
                                                <x-button class="text-white hover:bg-blue-700">
                                                    <a href="{{ route('schedules.show', $schedule) }}">View Feedback</a>
                                                </x-button>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-4">No schedules found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmScheduleDeletion(id) {
            if (confirm("Are you sure you want to delete this schedule? This action cannot be undone.")) {
                document.getElementById('delete-schedule-' + id).submit();
            }
        }
    </script>
</x-app-layout>
