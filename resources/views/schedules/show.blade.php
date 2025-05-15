<x-app-layout>
    <x-slot name="header">
        {{ __('Schedule Details') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @can('isAdmin')
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500 mb-4">
                <a href="{{ route('users.show', $schedule->user->id) }}">Back</a>
            </x-button>
            @endcan
            @can('isUser')
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500 mb-4">
                <a href="{{ route('schedules.index') }}">Back</a>
            </x-button>
            @endcan
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    @can('isAdmin')
                        <div><strong>User:</strong> {{ $schedule->user->name }}</div>
                        <div><strong>Email:</strong> {{ $schedule->user->email }}</div>
                        <div><strong>Phone:</strong> {{ $schedule->user->phone }}</div>
                    @endcan

                    <div><strong>Facility:</strong> {{ $schedule->facility->name }}</div>
                    <div><strong>Start:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i') }}</div>
                    <div><strong>End:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i') }}</div>
                    <div><strong>Reason:</strong> {{ $schedule->reasons }}</div>
                    <div><strong>Status:</strong>
                        <span class="
                            @if($schedule->status === 'approved') text-green-600 font-semibold
                            @elseif($schedule->status === 'rejected') text-red-600 font-semibold
                            @else text-yellow-600 font-semibold
                            @endif
                        ">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </div>

                    @if($schedule->status !== 'pending')
                        <div><strong>Feedback:</strong> {{ $schedule->feedback ?? 'No Feedback' }}</div>
                        <div><strong>Feedback By:</strong> {{ $schedule->user->name }}</div>
                    @endif

                    @can('isAdmin')
                        <div class="pt-4 border-t mt-4">
                            <form action="{{ route('schedules.approve-reject', $schedule) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                
                                @if($schedule->status === 'pending')
                                <div>
                                    <x-label for="status" class="block font-medium text-sm">Change Status</x-label>
                                    <select name="status" id="status" required 
                                        class="mt-1 rounded-md shadow-sm border-gray-300 py-1 px-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-40">
                                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                                </div>
                                @endif

                                <div>
                                    <x-label for="feedback" class="block font-medium text-sm">Feedback</x-label>
                                    <x-textarea name="feedback" id="description" placeholder="Provide feedback for either approve or reject">
                                        {{ old('feedback', $schedule->feedback) }}
                                    </x-textarea>
                                    @error('feedback')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <x-button class="px-6 py-2 text-white font-semibold rounded hover:bg-blue-700 transition">
                                        {{ __('Send Feeback') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
