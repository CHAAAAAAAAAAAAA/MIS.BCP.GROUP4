<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">📩 Submit Your Concern</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center gap-2">
                ✅ <strong>Success!</strong> Your concern has been submitted.
            </div>
        @endif

        <div class="bg-blue-500 text-white text-center font-semibold py-3 rounded-t-lg">
            ✏️ Fill in your concern below
        </div>

        <form action="{{ route('student.concerns.store') }}" method="POST" class="p-6 bg-white rounded-b-lg shadow-md">
            @csrf
            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Your Concern:</label>
                <textarea name="concern" 
                        class="w-full border rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" 
                        rows="5" required placeholder="Type your concern here..."></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                    🚀 Submit Concern
                </button>
            </div>
        </form>
    </div>
</x-user-layout>