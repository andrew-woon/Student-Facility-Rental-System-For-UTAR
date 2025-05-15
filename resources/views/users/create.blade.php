<x-app-layout>
    <x-slot name="header">
        {{ __('Create User') }}
    </x-slot>

    <div class="py-3">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-button class="bg-white text-blue-500 hover:bg-blue-300 border border-blue-500">
                <a href="{{ route('users.index') }}">Back</a>
            </x-button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" type="text" name="name" :value="old('name')" class="block w-full py-1 px-1" placeholder="Enter name"/>
                                @error('name')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="school_id" :value="__('School ID')" />
                                <x-input id="school_id" type="text" name="school_id" :value="old('school_id')" class="block w-full py-1 px-1" placeholder="Enter school ID"/>
                                @error('school_id')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" type="email" name="email" :value="old('email')" class="block w-full py-1 px-1" placeholder="Enter rmail"/>
                                @error('email')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" type="text" name="phone" :value="old('phone')" class="block w-full py-1 px-1" placeholder="Enter phone contact"/>
                                @error('phone')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" type="password" name="password" class="block w-full py-1 px-1" placeholder="Enter password"/>
                                @error('password')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-input id="password_confirmation" type="password" name="password_confirmation" class="block w-full py-1 px-1" placeholder="Confirm your password"/>
                                @error('password_confirmation')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-label for="role" :value="__('Role')" />
                            <select id="role" name="role"
                                class="mt-1 rounded-md shadow-sm border-gray-300 py-1 px-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-40">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-6">
                            <x-button class="px-6 py-2 text-white font-semibold rounded hover:bg-blue-700 transition">
                                {{ __('Store User') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
