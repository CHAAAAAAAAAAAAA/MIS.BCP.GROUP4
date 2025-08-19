<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Teachers</h1>
                    

                    <!-- Success Message -->
                    @if(session()->has('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('admin.auth.student.teacher') }}" class="mb-4">
                        <input type="text" name="search" placeholder="Search by name or number..." 
                            value="{{ request('search') }}"  {{-- ✅ Fixed Typo --}}
                            class="border rounded-lg p-2 w-1/3">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">
                            Search
                        </button>
                    </form>

                    <!-- Table -->
    <div class="overflow-y-auto max-h-300 border border-gray-300 rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal sticky top-0 z-10">
            <tr>

            <th class="py-3 px-6 text-left">Teacher NAME</th>
            <th class="py-3 px-6 text-left">Teacher NUMBER</th>
            <th class="py-3 px-6 text-left">ROLE/S</th>
            <th class="py-3 px-6 text-center">EDIT</th>
            <th class="py-3 px-6 text-center">DELETE</th>
        </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
            @foreach($students as $student)
            @if(str_contains($student->roles, 'teacher'))
                @php
                    $roles = is_array($student->roles) ? implode(',', $student->roles) : $student->roles;
                    $bgColor = 'bg-white';
        
                    if (str_contains($roles, 'admin')) {
                        $bgColor = 'bg-yellow-200';
                    } elseif (str_contains($roles, 'teacher')) {
                        $bgColor = 'bg-blue-200';
                    } elseif (str_contains($roles, 'student')) {
                        $bgColor = 'bg-green-200';
                    } elseif (str_contains($roles, 'kupal')) {
                        $bgColor = 'bg-red-200';
                    }
                @endphp
        
                <tr class="border-b border-gray-300 hover:bg-gray-200 {{ $bgColor }}">
                <td class="py-3 px-6">{{ $student->last_name }} {{ $student->first_name }}</td>
                <td class="py-3 px-6">{{ $student->student_number }}</td>
                <td class="py-3 px-6">{{ $student->roles }}</td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('student.teacheredit', ['student' => $student]) }}" 
                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">
                        Edit
                    </a>
                </td>
                <td class="py-3 px-6 text-center">
                    <form method="post" action="{{ route('student.destroy', ['student' => $student]) }}" 
                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                        @csrf
                        @method('delete')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
        
        </tbody>
    </table>
</div>


            </div>
        </div>
        </div>
    </div>
</x-admin-layout>
