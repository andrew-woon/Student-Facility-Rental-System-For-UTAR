<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Schedule: ') . $schedule->facility->name }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('schedules.index') }}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white">
                    <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 space-y-1">
                            <x-label for="booking_date">Booking Date</x-label>
                            <x-input
                                id="booking_date"
                                type="date"
                                name="booking_date"
                                value="{{ $schedule->start_time->format('Y-m-d') }}"
                                class="mt-1 w-full p-1 bg-gray-100 cursor-not-allowed"
                                disabled
                            />
                        </div>

                        <div class="mb-4 flex justify-between space-x-3">
                            <div class="w-1/2">
                                <x-label for="start_time">Start Time</x-label>
                                <x-input
                                    id="start_time"
                                    type="text"
                                    name="start_time"
                                    value="{{ $schedule->start_time->format('H:i') }}"
                                    class="mt-1 w-full p-1 bg-gray-100 cursor-not-allowed"
                                    disabled
                                />
                            </div>

                            <div class="w-1/2">
                                <x-label for="end_time">End Time</x-label>
                                <x-input
                                    id="end_time"
                                    type="text"
                                    name="end_time"
                                    value="{{ $schedule->end_time->format('H:i') }}"
                                    class="mt-1 w-full p-1 bg-gray-100 cursor-not-allowed"
                                    disabled
                                />
                            </div>
                        </div>
                        
                        <div class="mb-4 space-y-1">
                            <x-label for="reasons">Reason</x-label>
                            <x-textarea name="reasons" id="reasons" placeholder="Mention your reasons for booking">
                                {{ old('reasons', $schedule->reasons) }}
                            </x-textarea>
                            @error('reasons')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <x-button class="px-6 py-2 text-white font-semibold rounded hover:bg-blue-700 transition">
                                {{ __('Update Schedule') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
