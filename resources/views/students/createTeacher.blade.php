<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Sign Up A Teacher</h1>

                <!-- Success Message -->
                @if(session()->has('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                    <form method="POST" action="{{ route('teacher.store') }}" class="space-y-6" id="teacherForm">
                        @csrf

                        <!-- Teacher Number -->
                        <div>
                            <label for="student_number" class="block text-gray-700 font-medium">
                                Teacher ID Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="student_number" name="student_number" placeholder="e.g. 2003194"
                                pattern="\d{7}" maxlength="7" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <p class="text-sm text-gray-500 mt-1">
                                Enter a 7-digit number. It will be saved as <code class="bg-gray-100 px-1 rounded">TCHR-YYYY-NNN</code>.
                            </p>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-gray-700 font-medium">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-gray-700 font-medium">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium">Email</label>
                            <input type="email" id="email" name="email" placeholder="teacher@example.com" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <!-- Confirmation Checkbox -->
                        <div class="flex items-start space-x-3 mt-4">
                            <input type="checkbox" id="roles" name="roles" value="teacher"
                                class="form-checkbox h-5 w-5 text-blue-600 border-blue-500 focus:ring-blue-500">
                            <label for="roles" class="text-gray-800 font-semibold cursor-pointer leading-tight">
                                <span class="text-red-600 font-bold">*</span> I confirm this user is a teacher
                                <span class="block text-sm text-gray-500 mt-1">This must be checked to enable the Save button.</span>
                            </label>
                        </div>

                        <!-- Save Button -->
                        <div>
                            <button type="submit"
                                id="saveButton"
                                disabled
                                class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition duration-200 opacity-50 cursor-not-allowed">
                                Save Teacher
                            </button>
                        </div>
                    </form>

                    <!-- Enable Save Button Script -->
                    <script>
                        const checkbox = document.getElementById('roles');
                        const saveButton = document.getElementById('saveButton');

                        checkbox.addEventListener('change', function () {
                            if (this.checked) {
                                saveButton.disabled = false;
                                saveButton.classList.remove('opacity-50', 'cursor-not-allowed');
                            } else {
                                saveButton.disabled = true;
                                saveButton.classList.add('opacity-50', 'cursor-not-allowed');
                            }
                        });
                    </script>

                <!-- JavaScript Validation -->
                <script>
                    const form = document.getElementById('teacherForm');
                    const saveButton = document.getElementById('saveButton');
                    const checkbox = document.getElementById('roles');

                    const requiredFields = [
                        document.getElementById('student_number'),
                        document.getElementById('last_name'),
                        document.getElementById('first_name'),
                        document.getElementById('email'),
                        checkbox
                    ];

                    function validateForm() {
                        const allFilled = requiredFields.every(field => {
                            if (field.type === 'checkbox') {
                                return field.checked;
                            }
                            return field.value.trim() !== '';
                        });

                        saveButton.disabled = !allFilled;
                        saveButton.classList.toggle('opacity-50', !allFilled);
                        saveButton.classList.toggle('cursor-not-allowed', !allFilled);
                    }

                    requiredFields.forEach(field => {
                        field.addEventListener('input', validateForm);
                        field.addEventListener('change', validateForm);
                    });

                    validateForm(); // Initial check
                </script>
            </div>
        </div>
    </div>
</x-admin-layout>