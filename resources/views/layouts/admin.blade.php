@stack('scripts')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine Persist (to save darkMode in localStorage) -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/@alpinejs/persist" defer></script>

</head>

<body
    x-data="{ open: true, darkMode: false }"
    :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-50 text-gray-900': !darkMode }"
    class="font-sans antialiased transition-colors duration-300"
>
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside
        :class="open ? 'w-64' : 'w-16'"
        :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-800'"
        class="transition-all duration-300 shadow-lg h-screen fixed flex flex-col z-20"
    >
        <!-- Sidebar Header -->
        <div
            :class="darkMode ? 'border-gray-700' : 'border-gray-200'"
            class="flex items-center justify-between px-4 py-3 border-b"
        >
            <div class="flex items-center space-x-2" x-show="open" x-transition>
                <a href="#">
                    <x-application-logo
                        :class="darkMode ? 'text-gray-300' : 'text-gray-700'"
                        class="h-10 w-auto"
                    />
                </a>
                <span
                    :class="darkMode ? 'text-white' : 'text-gray-900'"
                    class="text-xl font-bold"
                >ADMIN</span>
            </div>
            <button @click="open = !open" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    :class="darkMode ? 'text-gray-300' : 'text-gray-600'"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <!-- Sidebar Links -->
        <nav class="mt-4 flex-1 px-2 space-y-2 overflow-y-auto">
            <!-- Home -->
            <a
                href="{{ route('admin.dashboard') }}"
                :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                class="flex items-center px-4 py-3 rounded-lg transition"
            >
                <span class="text-lg">🏠</span>
                <span x-show="open" x-transition class="ml-2 font-medium">Home</span>
            </a>

            <hr :class="darkMode ? 'border-gray-700' : 'border-gray-200'" />

            <!-- User Management -->
            <div x-data="{ openMenu: false }">
                <button
                    @click="openMenu = !openMenu"
                    :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition"
                >
                    <div class="flex items-center">
                        <span class="text-lg">🎓</span>
                        <span x-show="open" x-transition class="ml-2">User Management</span>
                    </div>
                    <svg
                        :class="{ 'rotate-180': openMenu }"
                        class="w-5 h-5 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                    <a
                        href="{{ route('admin.auth.students.shs') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Senior High</a
                    >
                    <a
                        href="{{ route('admin.auth.student.index') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >College</a
                    >
                    <a
                        href="{{ route('admin.auth.student.create') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Personal Details</a
                    >
                </div>
            </div>

            <!-- Teacher -->
            <div x-data="{ openMenu: false }">
                <button
                    @click="openMenu = !openMenu"
                    :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition"
                >
                    <div class="flex items-center">
                        <span class="text-lg">👨‍🏫</span>
                        <span x-show="open" x-transition class="ml-2">Teacher</span>
                    </div>
                    <svg
                        :class="{ 'rotate-180': openMenu }"
                        class="w-5 h-5 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                    <a
                        href="{{ route('admin.auth.student.teacher') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Teacher List</a
                    >
                    <a
                        href="{{ route('admin.auth.student.createTeacher') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Sign Up Teacher</a
                    >
                </div>
            </div>

            <!-- Student Concern -->
            <div x-data="{ openMenu: false }">
                <button
                    @click="openMenu = !openMenu"
                    :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition"
                >
                    <div class="flex items-center">
                        <span class="text-lg">📝</span>
                        <span x-show="open" x-transition class="ml-2">Student Concern</span>
                    </div>
                    <svg
                        :class="{ 'rotate-180': openMenu }"
                        class="w-5 h-5 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                    <a
                        href="{{ route('admin.auth.students.studentsconcern') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Concerns</a
                    >
                    <a
                        href="{{ route('admin.dashboard') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Modules</a
                    >
                </div>
            </div>

            <!-- General Ledger -->
            <div x-data="{ openMenu: false }">
                <button
                    @click="openMenu = !openMenu"
                    :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition"
                >
                    <div class="flex items-center">
                        <span class="text-lg">💰</span>
                        <span x-show="open" x-transition class="ml-2">General Ledger</span>
                    </div>
                    <svg
                        :class="{ 'rotate-180': openMenu }"
                        class="w-5 h-5 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Transactions</a
                    >
                    <a
                        href="{{ route('admin.dashboard') }}"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="block px-4 py-2 rounded-lg transition"
                        >Balance Update</a
                    >
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div
        class="flex-1 transition-all duration-300"
        :class="open ? 'ml-64' : 'ml-16'"
        :class="darkMode ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-900'"
    >
        <!-- Top Navbar -->
        <nav
            :class="darkMode ? 'bg-gray-800 text-gray-200 shadow-md' : 'bg-white text-gray-700 shadow-md'"
            class="px-4 h-16 flex items-center justify-between transition-colors duration-300"
        >
            <!-- Sidebar Toggle -->
            <button
                @click="open = !open"
                class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    />
                </svg>
            </button>

            <!-- Dark Mode Toggle -->
            <button
                @click="darkMode = !darkMode"
                class="p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                :class="darkMode ? 'text-yellow-300' : 'text-gray-700'"
                title="Toggle Dark Mode"
            >
                <template x-if="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5" />
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M16.95 16.95l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M16.95 7.05l1.42-1.42"/>
                    </svg>
                </template>
                <template x-if="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                        <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                    </svg>
                </template>
            </button>

            <!-- Profile Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-700'"
                        class="px-3 py-2 text-sm font-medium rounded-md transition"
                    >
                        Profile ▼
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.adminedit')">Profile</x-dropdown-link>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </nav>

        <!-- Page Slot -->
        <main class="p-6">
            <div :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'" class="shadow-md rounded-lg p-6 transition-colors duration-300">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>
</html>
@stack('scripts')
