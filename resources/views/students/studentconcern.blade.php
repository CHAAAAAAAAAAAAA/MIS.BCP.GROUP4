    <x-user-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-slate-700 leading-tight flex items-center gap-2">
                📩 <span>Submit Your Concern</span>
            </h2>
        </x-slot>

        <div class="max-w-5xl mx-auto p-8 bg-white shadow-xl rounded-xl">
            @if(session('success'))
                <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-md mb-6 flex items-center gap-2">
                    ✅ <strong>Success!</strong> Your concern has been submitted.
                </div>
            @endif

            <div class="bg-slate-700 text-white text-center font-semibold py-4 rounded-t-xl">
                ✏️ Fill in your concern below
            </div>

            <form action="{{ route('student.concerns.store') }}" method="POST" class="p-8 bg-white rounded-b-xl border border-gray-200 shadow-sm">
                @csrf
                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Your Concern:</label>
                    <textarea name="concern"
                            class="w-full border border-gray-300 rounded-lg p-4 text-base text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-slate-500 resize-none"
                            rows="7" required placeholder="Type your concern here..."></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-slate-700 text-white px-8 py-3 rounded-md shadow-md hover:bg-slate-800 transition">
                        🚀 Submit Concern
                    </button>
                </div>
            </form>
        </div>
    </x-user-layout>