<x-admin-layout>
    {{-- 🔹 Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- ✅ Success Alert --}}
    @if(session('success'))
        <div class="bg-green-500 text-white text-center font-semibold p-3 rounded-md mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- 🔹 Welcome Card --}}
    <div class="bg-gradient-to-r from-slate-800 to-slate-700 shadow-md rounded-xl p-6 mb-6">
        <h3 class="text-2xl font-bold text-white">
            Welcome, Admin {{ Auth::user()->name }}!
        </h3>
        <p class="mt-2 text-slate-300 text-sm">
            You have full access to manage users, monitor activities, and configure the system.
        </p>
    </div>

    {{-- 🔹 Stats Overview --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $stats = [
                [
                    'label' => 'Students',
                    'count' => $studentCount + $sstudentCount,
                    'icon' => 'M17 20h5v-2a3 3 0 00-3-3h-4a3 3 0 00-3 3v2h5z M12 12a4 4 0 100-8 4 4 0 000 8z'
                ],
                [
                    'label' => 'Teachers',
                    'count' => $teacherCount,
                    'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0v7'
                ],
                [
                    'label' => 'Admin',
                    'count' => $adminCount,
                    'icon' => 'M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3z M6 20v-2a4 4 0 014-4h4a4 4 0 014 4v2'
                ],
                [
                    'label' => 'All Person',
                    'count' => $allpersonCount,
                    'icon' => 'M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z'
                ],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="bg-white rounded-xl p-4 flex items-center shadow-sm border border-gray-200">
                <div class="bg-slate-200 p-3 rounded-full">
                    <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h6 class="text-slate-500 text-sm font-semibold">{{ $stat['label'] }}</h6>
                    <h6 class="text-2xl font-extrabold text-slate-800">{{ $stat['count'] }}</h6>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 🔹 Roles Chart --}}
    <div class="flex justify-center items-center mt-10">
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 w-full max-w-2xl">
            <h3 class="text-base font-semibold mb-6 text-gray-700">Roles Distribution</h3>
            <div class="w-full h-80">
                <canvas id="rolesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- 🔹 Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const ctx = document.getElementById('rolesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Student', 'Teacher', 'Admin', 'All Person'],
                        datasets: [{
                            label: 'Number of People',
                            data: [
                                {{ $studentCount + $sstudentCount }},
                                {{ $teacherCount }},
                                {{ $adminCount }},
                                {{ $allpersonCount }}
                            ],
                            backgroundColor: [
                                'rgba(100,116,139,0.7)',
                                'rgba(71,85,105,0.7)',
                                'rgba(107,114,128,0.7)',
                                'rgba(148,163,184,0.7)'
                            ],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, ticks: { color: '#475569' } },
                            x: { ticks: { color: '#475569' } }
                        },
                        plugins: { legend: { display: false } }
                    }
                });
            });
        </script>
    @endpush


{{-- 
    🔹 User List
    <div class="overflow-x-auto mt-10">
        <div class="bg-white shadow-md rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 px-6 py-4 border-b">
                List of Users (Grouped by Section & Program)
            </h3>

            @foreach($users->groupBy('program') as $program => $programUsers)
                <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                    📚 Program: {{ $program }}
                </div>

                @foreach($programUsers->groupBy('section') as $section => $sectionUsers)
                    <div class="bg-blue-200 text-gray-800 px-6 py-2 font-medium rounded-md mt-2">
                        🏫 Section: {{ $section }}
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 mb-6">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach(['Student Number','Name','Date Of Birth','Gender','Phone','Email','Created At'] as $col)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ $col }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @foreach($sectionUsers as $user)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-6 py-4">{{ $user->student_number }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($user->dob)->format('F j, Y') }}</td>
                                    <td class="px-6 py-4">{{ $user->gender }}</td>
                                    <td class="px-6 py-4">{{ $user->phone }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @endforeach
        </div>
    </div>
--}}

</x-admin-layout>
