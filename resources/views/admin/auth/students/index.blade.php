<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            College Student Management
        </h2>
    </x-slot>

    <div class="p-6 rounded-lg bg-white dark:bg-gray-800 transition">
        <div class="mb-6">
            <h3 class="text-gray-900 dark:text-white">
                List of College Students (Grouped by Program & Section)
            </h3>
            <p class="text-gray-700 dark:text-gray-300">This text follows dark mode</p>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center gap-4 mb-4">
            <form method="GET" action="{{ route('admin.students.collegeSearch') }}" class="flex w-full">
                <input type="text" name="search" placeholder="Search by Name, Student Number, Course"
                    value="{{ request('search') }}"
                    class="border rounded-lg p-2 w-1/3 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">
                    Search
                </button>
            </form>
        </div>

        @if($users->isEmpty())
            <p class="text-red-500 font-semibold mt-4 text-center">No students found.</p>
        @else
            @foreach($users->groupBy('program')->filter(function ($program, $key) {
                return in_array($key, ['BSBA', 'BSOA', 'BSIT', 'BSCpE', 'BSTM', 'BSCrim', 'BSPsy', 'BLIS']);
            }) as $program => $programUsers)
                <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                    College Program: {{ $program }}
                </div> 

                @foreach($programUsers->groupBy('section') as $section => $sectionUsers)
                    <div class="bg-blue-200 text-gray-800 px-6 py-2 font-medium rounded-md mt-2">
                        Section: {{ $section }}
                    </div>

                    <!-- Student Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-md">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Student Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Year Level</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($sectionUsers as $user)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-6 py-4">{{ $user->student_number }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->gender }}</td>
                                        <td class="px-6 py-4">{{ $user->year_level }}</td>

                                        <!-- Action Buttons -->
                                        <td class="px-3 py-2 text-center flex items-center justify-center gap-2">
                                            <!-- View -->
                                            <button onclick="secureView('{{ $user->id }}', '{{ $user->student_number }}', '{{ $user->name }}', '{{ $user->year_level }}', '{{ \Carbon\Carbon::parse($user->dob)->format('F j, Y') }}', '{{ $user->gender }}', '{{ $user->email }}')" 
                                                    class="text-blue-600 hover:text-blue-800" title="View Student">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>

                                            <!-- Edit -->
                                            <button onclick="secureEdit('{{ route('admin.students.edit', $user->id) }}')" 
                                                    class="text-yellow-600 hover:text-yellow-700" title="Edit Student">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </button>

                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('admin.students.destroy', $user->id) }}" class="inline delete-student-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="secureDelete(this)" 
                                                        class="text-red-600 hover:text-red-700" title="Delete Student">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z" />
                                                    </svg>
                                                </button>
                                            </form>
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

    <!-- SweetAlert + JS Logic -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const ADMIN_PASS = "00000000"; // master password

        function askPassword(action, onSuccess) {
            Swal.fire({
                title: `Enter Password to ${action}`,
                input: 'password',
                inputPlaceholder: 'Enter password',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                preConfirm: (pw) => {
                    if (pw !== ADMIN_PASS) Swal.showValidationMessage('❌ Incorrect password');
                    return pw;
                }
            }).then(result => {
                if (result.isConfirmed && result.value === ADMIN_PASS) {
                    onSuccess();
                }
            });
        }

        function secureView(id, student_number, name, year_level, dob, gender, email) {
            askPassword("View", () => {
                Swal.fire({
                    title: "📖 Student Details",
                    html: `
                        <div class="text-left">
                            <p><b>🆔 Student Number:</b> ${student_number}</p>
                            <p><b>👤 Name:</b> ${name}</p>
                            <p><b>🚻 Gender:</b> ${gender}</p>
                            <p><b>📘 Year Level:</b> ${year_level}</p>
                            <p><b>🎂 Date of Birth:</b> ${dob}</p>
                            <p><b>📧 Email:</b> ${email}</p>
                        </div>
                    `,
                    confirmButtonText: "Close",
                    width: 500
                });
            });
        }

        function secureEdit(url) {
            askPassword("Edit", () => window.location.href = url);
        }

        function secureDelete(button) {
            askPassword("Delete", () => button.closest("form").submit());
        }
    </script>
</x-admin-layout>
