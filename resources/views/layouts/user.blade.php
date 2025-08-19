<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body
    x-data="{ open: true, darkMode: false }"
    :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-50 text-gray-900': !darkMode }"
    class="font-sans antialiased transition-colors duration-300"
>
    <div class="relative min-h-screen flex flex-row">

        <!-- Sidebar -->
        <aside 
            :class="open ? 'w-64' : 'w-0 md:w-16'" 
            :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-800'"
            class="transform transition-all duration-300 ease-in-out shadow-xl sticky top-0 min-h-screen overflow-y-auto rounded-r-2xl flex flex-col z-20"
        >
            <!-- Sidebar Header -->
            <div 
                :class="darkMode ? 'border-gray-700' : 'border-gray-200'"
                class="flex items-center justify-between px-4 py-4 border-b"
            >
                <div class="flex items-center space-x-3" x-show="open" x-transition>
                    <a href="#">
                        <x-application-logo 
                            :class="darkMode ? 'text-gray-300' : 'text-gray-700'" 
                            class="h-10 w-auto"
                        />
                    </a>
                    <span 
                        :class="darkMode ? 'text-white' : 'text-gray-900'"
                        class="text-2xl font-extrabold tracking-wide"
                    >
                        USER
                    </span>
                </div>

                <!-- Close Button -->
                <button 
                    @click="open = !open" 
                    class="p-2 rounded-lg transition"
                    :class="darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-600 hover:bg-gray-100'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Nav -->
            <nav class="mt-4 flex-1 px-2 space-y-2 overflow-y-auto">
                <!-- Dashboard -->
                <a 
                    href="{{ route('userdashboard') }}"
                    :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                    class="flex items-center px-4 py-3 rounded-lg transition"
                >
                    <span class="text-lg">🏠</span>
                    <span x-show="open" x-transition class="ml-2 font-medium">Dashboard</span>
                </a>

                <hr :class="darkMode ? 'border-gray-700' : 'border-gray-200'" />

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
                        <svg :class="{ 'rotate-180': openMenu }" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                        <a 
                            href="{{ route('students.studentconcern') }}"
                            :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                            class="block px-4 py-2 rounded-lg transition"
                        >
                            Concern
                        </a>
                        <a 
                            href="{{ route('userdashboard') }}"
                            :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                            class="block px-4 py-2 rounded-lg transition"
                        >
                            Module
                        </a>
                    </div>
                </div>

                <hr :class="darkMode ? 'border-gray-700' : 'border-gray-200'" />

                <!-- User Module -->
                <div x-data="{ openMenu: false }">
                    <button 
                        @click="openMenu = !openMenu"
                        :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition"
                    >
                        <div class="flex items-center">
                            <span class="text-lg">📘</span>
                            <span x-show="open" x-transition class="ml-2">User Module</span>
                        </div>
                        <svg :class="{ 'rotate-180': openMenu }" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openMenu" x-transition class="pl-6 mt-2 space-y-2">
                        <a 
                            href="{{ route('userdashboard') }}"
                            :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                            class="block px-4 py-2 rounded-lg transition"
                        >
                            Module 1
                        </a>
                        <a 
                            href="{{ route('userdashboard') }}"
                            :class="darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-800'"
                            class="block px-4 py-2 rounded-lg transition"
                        >
                            Module 2
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">

            <!-- Top Navbar -->
            <nav 
                :class="darkMode 
                    ? 'bg-gray-900 text-white border-b border-gray-700' 
                    : 'bg-white text-gray-900 border-b border-gray-200'" 
                class="w-full shadow-md transition-colors duration-300"
            >
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        
                        <!-- Sidebar Toggle -->
                        <button
                            @click="open = !open"
                            class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
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
                        <div class="flex items-center space-x-3">
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
                                    <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-6">
                <div 
                    :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'" 
                    class="shadow-md rounded-lg p-6 transition-colors duration-300"
                >
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
