<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎓 Student Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-4 space-y-6">
        <!-- Welcome Box -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-700 shadow-md rounded-xl p-6 mb-6">
            <h3 class="text-2xl font-bold text-white">
                Welcome, {{ Auth::user()->name }}! 🎉
            </h3>
            <p class="mt-2 text-slate-300 text-sm">
                You are now logged into your personalized student portal.
            </p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">{{ Auth::user()->name }}</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Full Name</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Student Number</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->student_number }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">
                        @if(Auth::user()->gender === 'Male') @elseif(Auth::user()->gender === 'Female')@endif Gender
                    </span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->gender }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Date Of Birth</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->dob }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Adress</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->address }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Phone Number</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->phone }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Email Address</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Courses/Strand</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->program }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Year Level</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->year_level }} {{ Auth::user()->semester }} </span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm text-gray-600">Section</span>
                    <span class="text-lg font-medium text-gray-900">{{ Auth::user()->section }}</span>
                </div>
                <div class="flex flex-col">
                <span class="text-sm text-gray-600">Class Schedule</span>
                <span class="text-lg font-medium text-gray-900">{{ Auth::user()->schedule }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects Table -->
<div class="bg-white shadow-lg rounded-xl p-6 mt-6">
    <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Enrolled Subjects</h4>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Schedule</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Instructor</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                <!-- Example row, replace with your dynamic data -->
                <tr>
                    <td class="px-4 py-3 font-medium text-gray-900">BSIT-101</td>
                    <td class="px-4 py-3">Introduction to IT</td>
                    <td class="px-4 py-3">Mon & Wed | 10:30 AM - 12:30 PM</td>
                    <td class="px-4 py-3">Prof. Jane Doe</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium text-gray-900">BSIT-202</td>
                    <td class="px-4 py-3">Web Development</td>
                    <td class="px-4 py-3">Tue & Thu | 1:00 PM - 3:00 PM</td>
                    <td class="px-4 py-3">Prof. John Smith</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

</x-user-layout>
