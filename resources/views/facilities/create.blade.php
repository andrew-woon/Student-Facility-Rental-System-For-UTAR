<x-app-layout>
    <x-slot name="header">
        {{ __('Create Facility') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('facilities.index') }}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('facilities.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-label for="name" class="block text-sm font-medium text-gray-700">Facility Name</x-label>
                            <x-input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name" class="w-full"/>
                            @error('name')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="location" class="block text-sm font-medium text-gray-700">Location</x-label>
                            <x-input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Enter location" class="w-full"/>
                            @error('location')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="description" class="block text-sm font-medium text-gray-700">Description</x-label>
                            <x-textarea name="description" id="description" placeholder="Enter description">
                            </x-textarea>
                            @error('description')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-button class="px-6 py-2 text-white font-semibold rounded hover:bg-blue-700 transition">
                                {{ __('Store Facility') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
