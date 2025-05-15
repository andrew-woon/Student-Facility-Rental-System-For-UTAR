<x-app-layout>
    <x-slot name="header">
        {{ __('Schedules') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                </x-button>
                <form id="delete-schedule-expired" action="{{ route('schedules.cleanup') }}" method="GET">
                    <x-button type="button" onclick="confirmExpiredDeletion()" class="bg-red-500 text-white hover:bg-red-700">
                        Delete Expired Schedules
                    </x-button>
                </form>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-front sm:justify-front space-y-4 sm:space-y-0">
                    <form action="{{ route('schedules.index') }}" method="GET" class="flex flex-wrap justify-center gap-3">
                        <input type="text" name="facility_search" value="{{ request('facility_search') }}"
                            placeholder="Search facilities..." class="px-4 py-2 border border-gray-300 rounded-md">

                        <input type="text" name="user_search" value="{{ request('user_search') }}"
                            placeholder="Search users..." class="px-4 py-2 border border-gray-300 rounded-md">

                        <input type="date" name="date" value="{{ request('date') }}" 
                            min="{{ \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}"
                            max="{{ \Carbon\Carbon::now()->addMonths(3)->format('Y-m-d') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md">
                        
                        <select name="status" class="px-4 py-2 border border-gray-300 rounded-md">
                            <option value="all" {{ request('status', 'pending') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="pending" {{ request('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded">Search</button>
                    </form>
                    </div>
                    <table class="w-full table-auto border-collapse border border-gray-300 mt-3">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">User</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Phone</th>
                                <th class="border px-4 py-2">Facility</th>
                                <th class="border px-4 py-2">Start Time</th>
                                <th class="border px-4 py-2">End Time</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ $schedule->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->user->email }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->user->phone }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->facility->name }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->start_time }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $schedule->end_time }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <span class="@if($schedule->status === 'approved') text-green-600 font-semibold 
                                                    @elseif($schedule->status === 'pending') text-yellow-500 font-semibold 
                                                    @elseif($schedule->status === 'rejected') text-red-600 font-semibold 
                                                    @else text-gray-600 @endif">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2 flex justify-center items-center space-x-2">
                                        <x-button class="px-4 py-2 text-white hover:bg-blue-700">
                                            <a href="{{ route('schedules.show', $schedule) }}">Manage</a>
                                        </x-button>                                       
                                    </td>
                                </tr>
                            @endforeach
                            @if ($schedules->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">No schedules found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $schedules->links() }}
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <form method="GET" action="{{ route('schedules.index') }}" class="flex items-center space-x-2">
                            <x-label for="page" class="text-sm">Go to page:</x-label>
                            <x-input type="number" name="page" id="page" min="1" max="{{ $schedules->lastPage() }}" class="w-20 px-2 py-1 border rounded"/>
                            <x-button class="text-white hover:bg-blue-700 ">Go</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function confirmScheduleDeletion(id) {
        if (confirm("Are you sure you want to delete this schedule? This action is permanent and cannot be undone.")) {
            document.getElementById('delete-schedule-' + id).submit();
        }
    }
    function confirmExpiredDeletion() {
        if (confirm("Are you sure you want to delete **all expired** schedules one month ago? This action cannot be undone.")) {
            document.getElementById('delete-schedule-expired').submit();
        }
    }
</script>