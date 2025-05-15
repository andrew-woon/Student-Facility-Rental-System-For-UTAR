<x-app-layout>
    <x-slot name="header">
        {{ __('Facility Schedule: ' . $facility->name) }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('facilities.index') }}">Back</a>
            </x-button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200 space-y-3">
                    <h3 class="text-xl font-semibold">{{ $facility->name }}</h3>
                    <p><strong>Location:</strong> {{ $facility->location }}</p>
                    <p><strong>Description:</strong> {{ $facility->description }}</p>

                    <div class="overflow-auto border rounded" style="max-height:600px">
                        <table class="table-auto min-w-[1800px] text-sm text-center">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr>
                                    <th class="w-24 border px-1 py-2">Day</th>
                                    <th class="w-32 border px-1 py-2">Date</th>
                                    @foreach(range(6,21) as $hour)
                                        @foreach(['00','30'] as $minute)
                                            <th class="border px-1 py-2">{{ sprintf('%02d:%s',$hour,$minute) }}</th>
                                        @endforeach
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($days as $day)
                                    <tr class="{{ now()->format('Y-m-d') === $day ? 'bg-blue-50 font-semibold' : '' }}">
                                        <td class="border px-1 py-2">{{ \Carbon\Carbon::parse($day)->format('D') }}</td>
                                        <td class="border px-1 py-2">{{ \Carbon\Carbon::parse($day)->format('M d, Y') }}</td>

                                        @php
                                            $slots = collect();
                                            foreach(range(6,21) as $h) {
                                                foreach(['00','30'] as $m) {
                                                    $slots->push(sprintf('%02d:%s',$h,$m));
                                                }
                                            }
                                            $dayBlocks = collect($blocks[$day] ?? []);
                                            $i = 0;
                                            $total = $slots->count();
                                        @endphp

                                        @while($i < $total)
                                            @php
                                                $slot = $slots[$i];
                                                $block = $dayBlocks->get($slot);
                                            @endphp

                                            @if($block)
                                                <td colspan="{{ $block['span'] }}" class="relative h-10 p-0 booked-slot @can('isAdmin') admin-hover @endcan">
                                                    @can('view', $block['schedule'])
                                                        <a href="{{ route('schedules.show', $block['schedule']) }}" class="absolute inset-0 block h-full w-full">
                                                            <div class="tooltip-container absolute inset-0 flex items-center justify-center">
                                                                @can('isAdmin')
                                                                    <div class="tooltip text-xs px-2 py-1 rounded shadow">
                                                                        {{ $block['schedule']->user->name }}
                                                                        <span class="tooltip-arrow"></span>
                                                                    </div>
                                                                @endcan
                                                            </div>
                                                        </a>
                                                    @endcan
                                                    <span class="text-xs">Booked</span>
                                                </td>
                                                @php $i += $block['span']; @endphp
                                            @else
                                                <td class="h-10 w-10 border"></td>
                                                @php $i++; @endphp
                                            @endif
                                        @endwhile
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @can('create', \App\Models\Schedule::class)
                        <div class="mt-6">
                            <x-button class="text-white font-semibold rounded hover:bg-blue-700 transition">
                                <a href="{{ route('schedules.create', $facility) }}">{{ __('Book this Facility') }}</a>
                            </x-button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <style>
        .booked-slot { background-color: #1e40af; color: white; }
        .tooltip-container { display: none; }
        .admin-hover:hover .tooltip-container { display: flex; }

        .tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(-4px);
            background: rgba(0,0,0,0.75);
            color: #fff;
            white-space: nowrap;
        }
        .tooltip-arrow {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 0; height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid rgba(0,0,0,0.75);
        }
    </style>

    <script>
        window.onload = () => {
            const todayRow = document.querySelector('tr.bg-blue-50');
            if (todayRow) todayRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };
    </script>
</x-app-layout>