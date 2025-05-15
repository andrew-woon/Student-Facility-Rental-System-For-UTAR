<x-app-layout> 
    <x-slot name="header">
        {{ __('Create Facility Schedule: ') . $facility->name }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('facilities.index') }}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white">
                    <form action="{{ route('schedules.store', $facility) }}" method="POST">
                        @csrf
                        <input type="hidden" name="facility_id" value="{{ $facility->id }}">

                        <div class="mb-4 space-y-1">
                            <x-label for="booking_date">Booking Date</x-label>
                            <x-input
                                id="booking_date"
                                type="date"
                                name="booking_date"
                                :value="old('booking_date')"
                                min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                max="{{ \Carbon\Carbon::now()->addMonths(3)->format('Y-m-d') }}"
                                class="mt-1 w-full p-1"
                                required
                            />
                            @error('booking_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 flex justify-between space-x-3">
                            <div class="w-1/2">
                                <x-label for="start_time">Start Time</x-label>
                                <select id="start_time" name="start_time" class="w-full border-gray-300 rounded-md py-1 px-2">
                                    @for ($hour = 6; $hour <= 21; $hour++)
                                        @foreach (['00', '30'] as $minute)
                                            @php
                                                $time = sprintf('%02d:%s', $hour, $minute);
                                            @endphp
                                            <option value="{{ $time }}" @selected(old('start_time') == $time)>{{ $time }}</option>
                                        @endforeach
                                    @endfor
                                </select>
                                @error('start_time')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-1/2">
                                <x-label for="end_time">End Time</x-label>
                                <select id="end_time" name="end_time" class="w-full border-gray-300 rounded-md py-1 px-2">
                                    @for ($hour = 6; $hour <= 21; $hour++)
                                        @foreach (['00', '30'] as $minute)
                                            @php
                                                $time = sprintf('%02d:%s', $hour, $minute);
                                            @endphp
                                            <option value="{{ $time }}" @selected(old('end_time') == $time)>{{ $time }}</option>
                                        @endforeach
                                    @endfor
                                </select>
                                @error('end_time')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @error('conflict')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="mb-4 space-y-1">
                            <x-label for="reasons">Reason</x-label>
                            <x-textarea 
                                id="reasons" 
                                name="reasons" 
                                placeholder="Mention your reasons for booking"
                            />
                            @error('reasons')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <x-button class="px-6 py-2 text-white font-semibold rounded hover:bg-blue-700 transition">
                                {{ __('Store Schedule') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
