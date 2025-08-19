<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎓 College Student Management
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 bg-white px-6 py-4 border-b">
                📚 List of Senior High School Students (Grouped by Program & Section)
            </h3>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center gap-4 mb-4">
            <form method="GET" action="{{ route('admin.students.shsSearch') }}" class="flex w-full">
                <input type="text" name="search" placeholder="Search by Name, Student number, Course" 
                    value="{{ request('search') }}"
                    class="border rounded-lg p-2 w-1/3">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">
                    Search
                </button>
            </form>
        </div>

        @if($users->isEmpty())
            <p class="text-red-500 font-semibold mt-4 text-center">🚫 No students found.</p>
        @else
            @foreach($users->groupBy('program')->filter(function ($program, $key) {
                return in_array($key, ['TVL', 'STEM', 'ABM', 'HUMSS', 'GAS', 'ICT']);
            }) as $program => $programUsers)
                <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                    🎓 SHS Program: {{ $program }}
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
                                @foreach($sectionUsers->whereIn('year_level', ['Grade 11', 'Grade 12']) as $user)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->student_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->year_level }} - {{ $user->semester }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->dob)->format('F j, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->gender }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('M d, Y h:i A') }}</td>
                
                                    <!-- Action Buttons -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.students.edit', $user->id) }}" 
                                                class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                                                ✏️ Edit
                                            </a>
                
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.students.destroy', $user->id) }}" 
                                                onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                                                    ❌ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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