<x-admin-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ route('admin.auth.student.store') }}" class="space-y-6">
            @csrf

            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                📝 Register a New Student
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date of Birth -->
                <div>
                    <x-input-label for="dob" :value="__('Date of Birth')" />
                    <x-text-input id="dob" type="date" name="dob" :value="old('dob')" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                </div>

                <!-- Gender -->
                <div>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" type="text" name="address" :value="old('address')" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone Number -->
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" />
                    <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Program -->
                <div>
                    <x-input-label for="program" :value="__('Course / Program')" />
                    <select id="program" name="program" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>-- Select Program --</option>
                        <optgroup label="Senior High School Tracks">
                            <option value="ABM">Accountancy, Business, and Management (ABM)</option>
                            <option value="HUMSS">Humanities and Social Sciences (HUMSS)</option>
                            <option value="STEM">Science, Technology, Engineering, and Mathematics (STEM)</option>
                            <option value="ICT">Information and Communications Technology (ICT)</option>
                        </optgroup>
                        <optgroup label="College Degree Programs">
                            <option value="BSBA">Bachelor of Science in Business Administration</option>
                            <option value="BSIT">Bachelor of Science in Information Technology</option>
                            <option value="BSCpE">Bachelor of Science in Computer Engineering</option>
                            <option value="BSTM">Bachelor of Science in Tourism Management</option>
                            <option value="BSCrim">Bachelor of Science in Criminology</option>
                        </optgroup>
                    </select>
                    <x-input-error :messages="$errors->get('program')" class="mt-2" />
                </div>
            </div>

            <!-- Year Level & Semester -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="year_level" :value="__('Year Level')" />
                    <select id="year_level" name="year_level"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>-- Select Year Level --</option>
                        <optgroup label="Senior High School">
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                        </optgroup>
                        <optgroup label="College">
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </optgroup>
                    </select>
                    <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="semester" :value="__('Semester')" />
                    <select id="semester" name="semester"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>-- Select Semester --</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <x-primary-button class="px-6 py-2">
                    {{ __('Register Student') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-layout>