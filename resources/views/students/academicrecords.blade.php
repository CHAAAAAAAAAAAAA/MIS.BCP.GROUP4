    <x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Academic Records') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 bg-white p-8 rounded-lg shadow-lg border">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800 bg-gray-100 px-6 py-4 rounded-t-lg border-b">
                👨‍🎓 Overall List of Students
            </h3>
        </div>
    

            <div class="flex items-center gap-4 mb-4">
            <form method="GET" action="{{ route('students.academicrecords') }}" class="flex w-full">
                <input type="text" name="search" placeholder="Search by Name, Student number, Course" 
                    value="{{ request('search') }}"
                    class="border rounded-lg p-2 w-1/3">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">
                    Search
                </button>
            </form>
        </div>      



        @if($users->isEmpty())
                <p class="text-red-500 font-semibold mt-4">🚫 Student not found.</p>
            @else
                @foreach($users->groupBy('program') as $program => $programUsers)
                    <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                        📚 Program: {{ $program }}
                    </div>
            
                    @foreach($programUsers->groupBy('section') as $section => $sectionUsers)
                        <div class="bg-blue-200 text-gray-800 px-6 py-2 font-medium rounded-md mt-2">
                            🏫 Section: {{ $section }}
                        </div>
            
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-md">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Of Birth</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($sectionUsers as $user)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->student_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->year_level }} {{ $user->semester }}</td>
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
    </div>
    </x-admin-layout>