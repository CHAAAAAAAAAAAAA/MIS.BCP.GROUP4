<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select name="gender" id="gender" class="block mt-1 w-full" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Course / Program -->
        <div class="mt-4">
            <x-input-label for="program" :value="__('Course / Program')" />
            <select id="program" name="program" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="" disabled selected>-- Select Program --</option>

                <optgroup label="Senior High School Tracks">
                    <option value="ABM">Accountancy, Business, and Management (ABM)</option>
                    <option value="HUMSS">Humanities and Social Sciences (HUMSS)</option>
                    <option value="STEM">Science, Technology, Engineering, and Mathematics (STEM)</option>
                    <option value="ICT">Information and Communications Technology (ICT)</option>
                </optgroup>

                <optgroup label="College Degree Programs">
                    <option value="BSBA">Bachelor of Science in Business Administration</option>
                    <option value="BSOA">Bachelor of Science in Office Administration</option>
                    <option value="BSIT">Bachelor of Science in Information Technology</option>
                    <option value="BSCpE">Bachelor of Science in Computer Engineering</option>
                    <option value="BSHRM">Bachelor of Science in Hotel and Restaurant Management</option>
                    <option value="BSTM">Bachelor of Science in Tourism Management </option>
                    <option value="BSCrim">Bachelor of Science in Criminology</option>
                    <option value="BSPsy">Bachelor of Science in Psychology</option>
                    <option value="BLIS">Bachelor of Library and Information Science</option>
                </optgroup>
            </select>
            <x-input-error :messages="$errors->get('program')" class="mt-2" />
        </div>


        <!-- Year Level -->
        <div class="mt-4">
            <x-input-label for="year_level" :value="__('Year Level')" />
            <select id="year_level" name="year_level" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
        
        <!-- Semester Selection -->
        <div class="mt-4">
            <x-input-label for="semester" :value="__('Semester')" />
            <select id="semester" name="semester" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>-- Select Semester --</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
            </select>
            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
            href="{{ route('login') }}" 
            style="color: #1447e6 !important;">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
