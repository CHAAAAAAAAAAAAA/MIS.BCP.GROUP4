    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-slate-700 leading-tight flex items-center gap-2">
                📌 <span>Student Concerns</span>
            </h2>
        </x-slot>

        @if(session('new_concern'))
            <div class="bg-blue-50 border border-blue-300 text-blue-700 px-4 py-2 rounded-md mb-4 flex items-center gap-2">
                🔔 <strong>New Concern:</strong> {{ session('new_concern') }}
            </div>
        @endif

        <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
            @if(session('success'))
                <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-2 rounded-md mb-4 flex items-center gap-2">
                    ✅ <strong>Success!</strong> Concern Submitted.
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full bg-white divide-y divide-gray-200 text-sm">
                    <thead class="bg-slate-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">Student ID</th>
                            <th class="px-4 py-3 text-left font-medium">Name</th>
                            <th class="px-4 py-3 text-left font-medium">Concern</th>
                            <th class="px-4 py-3 text-left font-medium">Date & Time</th>
                            <th class="px-4 py-3 text-center font-medium">🗑️</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($concerns as $concern)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2 text-gray-700">{{ $concern->student->student_number ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-gray-800 font-semibold">{{ $concern->student->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-2 text-gray-600 max-w-[300px]">
                                    <div class="max-h-40 overflow-y-auto pr-2 text-sm leading-relaxed break-words scrollbar-thin scrollbar-thumb-slate-400 scrollbar-track-slate-100 hover:scrollbar-thumb-slate-500">
                                        {{ $concern->concern }}
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-gray-500 whitespace-nowrap">
                                    {{ $concern->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('concerns.destroy', $concern->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-500 hover:text-red-700 transition delete-btn" title="Delete Concern">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                        <script>
                                            const ADMIN_PASS = "00000000"; // master password

                                            function askPassword(action, onSuccess) {
                                                Swal.fire({
                                                    title: `<h2 style="font-size:22px; font-weight:bold;">Enter Password to ${action}</h2>`,
                                                    input: 'password',
                                                    inputPlaceholder: 'Enter password',
                                                    inputAttributes: {
                                                        autocapitalize: 'off',
                                                        style: 'font-size:18px; padding:10px;'
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Continue',
                                                    cancelButtonText: 'Cancel',
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
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

                                            document.addEventListener('DOMContentLoaded', () => {
                                                document.querySelectorAll('.delete-form').forEach(form => {
                                                    const btn = form.querySelector('.delete-btn');
                                                    btn.addEventListener('click', () => {
                                                        askPassword('delete concern', () => form.submit());
                                                    });
                                                });
                                            });
                                        </script>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">No student concerns found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-admin-layout>