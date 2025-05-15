<nav class="bg-gray-900 text-white px-6 py-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/">
                <img src="{{ asset('images/UTAR_Logo.jpg') }}" class="w-16 h-8 rounded-full" alt="UTAR Logo">
            </a>
            <a href="/" class="text-xl sm:text-2xl font-bold text-blue-400 hover:text-blue-500 transition">
                UTAR Facility Rental System
            </a>
        </div>

        <ul class="flex space-x-6 items-center text-sm font-medium">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a></li>
            @can('isAdmin')
                <li><a href="{{ route('users.index') }}" class="hover:text-blue-400 transition">Users</a></li>
            @endcan
            <li><a href="{{ route('facilities.index') }}" class="hover:text-blue-400 transition">Facilities</a></li>
            @can('isAdmin')
            <li><a href="{{ route('schedules.index') }}" class="hover:text-blue-400 transition">Schedules</a></li>
            @endcan
            @can('isUser')
            <li><a href="{{ route('users.show', Auth::user()) }}" class="hover:text-blue-400 transition">Schedules</a></li>
            @endcan
            <li><a href="{{ route('users.profile') }}" class="hover:text-blue-400 transition">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-red-400 transition">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</nav>