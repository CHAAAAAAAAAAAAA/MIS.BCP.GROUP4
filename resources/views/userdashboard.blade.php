<x-user-layout>
    {{-- 🔹 Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎓 Student Dashboard
        </h2>
    </x-slot>

    {{-- ✅ Success Alert --}}
    @if(session('success'))
        <div class="bg-green-500 text-white text-center font-semibold p-3 rounded-md mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- 🔹 Welcome Card (same design as admin) --}}
    <div class="bg-gradient-to-r from-slate-800 to-slate-700 shadow-md rounded-xl p-6 mb-6">
        <h3 class="text-2xl font-bold text-white">
            Welcome, {{ Auth::user()->name }}! 🎉
        </h3>
        <p class="mt-2 text-slate-300 text-sm">
            You are now logged into your personalized student portal.
        </p>
    </div>

        {{-- 🔹 Profile Card --}}
        <div class="bg-white shadow-md rounded-xl border border-gray-200 p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">👤 Student Profile</h4>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div><span class="text-sm text-gray-600">📛 Full Name</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->name }}</p></div>
                
                <div><span class="text-sm text-gray-600">🆔 Student Number</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->student_number }}</p></div>

                <div><span class="text-sm text-gray-600">
                    @if(Auth::user()->gender === 'Male') ♂️ @elseif(Auth::user()->gender === 'Female') ♀️ @endif Gender
                </span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->gender }}</p></div>

                <div><span class="text-sm text-gray-600">📅 Date of Birth</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->dob }}</p></div>

                <div><span class="text-sm text-gray-600">🏠 Address</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->address }}</p></div>

                <div><span class="text-sm text-gray-600">☎️ Phone Number</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->phone }}</p></div>

                <div><span class="text-sm text-gray-600">📧 Email Address</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->email }}</p></div>

                <div><span class="text-sm text-gray-600">📚 Courses/Strand</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->program }}</p></div>

                <div><span class="text-sm text-gray-600">🎓 Year Level</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->year_level }} {{ Auth::user()->semester }}</p></div>

                <div><span class="text-sm text-gray-600">🏫 Section</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->section }}</p></div>

                <div><span class="text-sm text-gray-600">🗓️ Class Schedule</span>
                    <p class="text-lg font-medium text-gray-900">{{ Auth::user()->schedule }}</p></div>
            </div>
        </div>

        {{-- 🔹 Subjects Table --}}
        <div class="bg-white shadow-md rounded-xl border border-gray-200 p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📘 Enrolled Subjects</h4>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach(['Subject Code','Subject Title','Schedule','Instructor'] as $col)
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ $col }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                        {{-- Example row (replace with dynamic data) --}}
                        <tr class="hover:bg-gray-100 transition duration-150">
                            <td class="px-4 py-3 font-medium text-gray-900">BSIT-101</td>
                            <td class="px-4 py-3">Introduction to IT</td>
                            <td class="px-4 py-3">Mon & Wed | 10:30 AM - 12:30 PM</td>
                            <td class="px-4 py-3">Prof. Jane Doe</td>
                        </tr>
                        <tr class="hover:bg-gray-100 transition duration-150">
                            <td class="px-4 py-3 font-medium text-gray-900">BSIT-202</td>
                            <td class="px-4 py-3">Web Development</td>
                            <td class="px-4 py-3">Tue & Thu | 1:00 PM - 3:00 PM</td>
                            <td class="px-4 py-3">Prof. John Smith</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-user-layout>
