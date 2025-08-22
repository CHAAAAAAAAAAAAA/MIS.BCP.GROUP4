    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transactions - Students List') }}
            </h2>
        </x-slot>

            <!-- 🔍 Search Form -->
            <form method="GET" action="{{ route('admin.transactions') }}" class="mb-4 flex items-center space-x-2">
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by Student No. or Name..." 
                    class="w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">

                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Search
                </button>
            </form>


            {{-- 🔹 User List --}}
            <div class="overflow-x-auto mt-4">
                <div class="bg-white shadow-md rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 px-6 py-4 border-b">
                        List of Users (Grouped by Section & Program)
                    </h3>

                    @foreach($users->groupBy('program') as $program => $programUsers)
                        <div class="bg-gray-100 text-gray-800 px-6 py-3 font-semibold mt-4 rounded-md">
                            📚 Program: {{ $program ?? 'N/A' }}
                        </div>

                        @foreach($programUsers->groupBy('section') as $section => $sectionUsers)
                            <div class="bg-blue-200 text-gray-800 px-6 py-2 font-medium rounded-md mt-2">
                                🏫 Section: {{ $section ?? 'N/A' }}
                            </div>

                            <table class="min-w-full divide-y divide-gray-200 mb-6">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @foreach(['Student Number','Name','Gender','Year Level'] as $col)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ $col }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach($sectionUsers as $user)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-6 py-4">{{ $user->student_number }}</td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->gender }}</td>
                                        <td class="px-6 py-4">{{ $user->year_level }}</td>

                                        {{-- 🔹 Add this link inside the foreach --}}
                                        <td class="px-6 py-4">
                                            <button onclick="askPassword('view transactions', () => window.location.href='{{ route('admin.transactions.show', $user->id) }}')"
                                                    class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out"
                                                    title="View Transactions"
                                                    style="background: none; border: none; padding: 0; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </td>

                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const ADMIN_PASS = "00000000"; // hardcoded password

    function askPassword(action, onSuccess) {
        Swal.fire({
            title: `<h2 style="font-size:22px; font-weight:bold;">Enter Password to ${action}</h2>`,
            input: 'password',
            inputPlaceholder: 'Enter password',
            showCancelButton: true,
            confirmButtonText: 'Continue',
            cancelButtonText: 'Cancel',
            preConfirm: (pw) => {
                if (pw !== ADMIN_PASS) {
                    Swal.showValidationMessage('❌ Incorrect password');
                }
                return pw;
            }
        }).then(result => {
            if (result.isConfirmed && result.value === ADMIN_PASS) {
                onSuccess();
            }
        });
    }
</script>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </x-admin-layout>
