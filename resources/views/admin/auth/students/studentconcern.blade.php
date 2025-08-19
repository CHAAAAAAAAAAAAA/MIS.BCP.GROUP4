<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">📌 Student Concerns</h2>
    </x-slot>

    <!-- Notification for new concerns -->
    @if(session('new_concern'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md relative mb-4">
            🔔 <strong>New Concern:</strong> {{ session('new_concern') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative mb-4">
                ✅ <strong>Success!</strong> Concern Submitted.
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">📄 Submitted Concerns</h3>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                + Add Concern
            </button>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
            <table class="min-w-full bg-white divide-y divide-gray-300">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Student ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Student Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Concern</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Delete</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse($concerns as $concern)
                        <tr class="hover:bg-gray-100 transition duration-200 align-top">
                            <td class="px-4 py-2 text-gray-700">{{ $concern->student->student_number ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-gray-700 font-semibold">{{ $concern->student->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 text-gray-600 break-words max-w-[300px]">
                                {{ $concern->concern }}
                            </td>
                            <td class="px-4 py-2 text-gray-500">{{ $concern->created_at->format('M d, Y h:i A') }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('concerns.destroy', $concern->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this concern?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white text-xs px-3 py-1.5 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
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