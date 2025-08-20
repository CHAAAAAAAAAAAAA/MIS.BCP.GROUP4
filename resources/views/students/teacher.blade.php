<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                    <form method="GET" action="{{ route('admin.auth.student.teacher') }}" class="mb-6">
                        <div class="flex flex-wrap items-center gap-4">
                            <!-- Search Label -->
                            <label for="search" class="text-gray-700 font-medium">
                                Search Teacher:
                            </label>

                            <!-- Search Input -->
                            <input type="text" id="search" name="search" placeholder="Name or Tearchers ID Number"
                                value="{{ request('search') }}"
                                class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                            <!-- Search Button -->
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                                Search
                            </button>

                            <!-- Reset Button -->
                            @if(request('search'))
                                <a href="{{ route('admin.auth.student.teacher') }}"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                    

                    <!-- Table -->
                    <div class="overflow-y-auto max-h-[600px] border border-gray-300 rounded-lg shadow-md">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal sticky top-0 z-10">
                                <tr>
                                    <th class="py-3 px-6 text-left">Teacher Name</th>
                                    <th class="py-3 px-6 text-left">ID Number</th>
                                    <th class="py-3 px-6 text-left">Role(s)</th>
                                    <th class="py-3 px-6 text-center">Edit</th>
                                    <th class="py-3 px-6 text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @forelse($students as $student)
                                    @if(str_contains($student->roles, 'teacher'))
                                        @php
                                            $roles = is_array($student->roles) ? implode(',', $student->roles) : $student->roles;
                                            $bgColor = match(true) {
                                                str_contains($roles, 'admin') => 'bg-yellow-100',
                                                str_contains($roles, 'teacher') => 'bg-blue-100',
                                                str_contains($roles, 'student') => 'bg-green-100',
                                                str_contains($roles, 'kupal') => 'bg-red-100',
                                                default => 'bg-white',
                                            };
                                        @endphp

                                        <tr class="border-b border-gray-300 hover:bg-gray-100 {{ $bgColor }}">
                                            <td class="py-3 px-6">{{ $student->last_name }} {{ $student->first_name }}</td>
                                            <td class="py-3 px-6">{{ $student->student_number }}</td>
                                            <td class="py-3 px-6">{{ $roles }}</td>
                                            <td class="py-3 px-6 text-center">
                                                <a href="{{ route('student.teacheredit', ['student' => $student]) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm"
                                                title="Edit Teacher">
                                                    ✏️ Edit
                                                </a>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <form method="POST" action="{{ route('admin.teachers.destroy', $student->id) }}" class="delete-teacher-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm delete-teacher-button"
                                                            title="Delete Teacher">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-red-500 font-semibold">
                                            No results found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- SweetAlert2 Delete Confirmation -->
                    <script>
                        document.querySelectorAll('.delete-teacher-button').forEach(button => {
                            button.addEventListener('click', function () {
                                const form = this.closest('form');

                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "This will permanently delete the teacher.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    </script>
            </div>
        </div>
        </div>
    </div>
</x-admin-layout>
