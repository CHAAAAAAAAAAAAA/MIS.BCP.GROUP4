<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎓 College Student Management
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 bg-white px-6 py-4 border-b">
                📚 List of College Students (Grouped by Program & Section)
            </h3>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center gap-4 mb-4">
            <form method="GET" action="{{ route('admin.students.collegeSearch') }}" class="flex w-full">
                <input type="text" name="search" placeholder="Search by Name, Student Number, Course"
                    value="{{ request('search') }}"
                    class="border rounded-lg p-2 w-1/3 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">
                    🔍 Search
                </button>
            </form>
        </div>

        @if($users->isEmpty())
            <p class="text-red-500 font-semibold mt-4 text-center">🚫 No students found.</p>
        @else
            @foreach($users->groupBy('program')->filter(function ($program, $key) {
                return in_array($key, ['BSBA', 'BSOA', 'BSIT', 'BSCpE', 'BSTM', 'BSCrim', 'BSPsy', 'BLIS']);
            }) as $program => $programUsers)
                <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                    📚 College Program: {{ $program }}
                </div> 

                @foreach($programUsers->groupBy('section') as $section => $sectionUsers)
                    <div class="bg-blue-200 text-gray-800 px-6 py-2 font-medium rounded-md mt-2">
                        🏫 Section: {{ $section }}
                    </div>

                    <!-- Student Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-md">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Student Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Year Level</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Date Of Birth</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Registered</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($sectionUsers->whereIn('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year']) as $user)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->student_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->year_level }} - {{ $user->semester }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->dob)->format('F j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->gender }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('M d, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
</x-admin-layout>