<x-admin-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white shadow-md rounded-lg p-6">
              <h1 class="text-2xl font-bold text-gray-800 mb-4">Create a SHS Student</h1>

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
              <form method="post" action="{{ route('student.store') }}" class="space-y-4">
                  @csrf

                  <div>
                      <label class="block text-gray-700 font-medium">Student Number</label>
                      <input type="text" name="student_number" placeholder="Student Number" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                  </div>

                  <div>
                      <label class="block text-gray-700 font-medium">Last Name</label>
                      <input type="text" name="last_name" placeholder="Last Name" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                  </div>

                  <div>
                      <label class="block text-gray-700 font-medium">First Name</label>
                      <input type="text" name="first_name" placeholder="First Name" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                  </div>

                  <div>
                      <label class="block text-gray-700 font-medium">Email</label>
                      <input type="text" name="email" placeholder="Email" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                  </div>


                  <label for="year_level" class="block text-gray-700 font-medium">Year Level</label>
                      <select name="year_level" id="year_level"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                          <option value="" disabled selected>Select your year level</option>
                          <option value="SHS 1st Sem">Senior High School 1st Sem</option>
                          <option value="SHS 2nd Sem">Senior High School 2nd Sem</option>
                          <option value="College 1st Year 1st Sem">1st Year and 1st Sem Collage</option>
                          <option value="College 1st Year 1st Sem">1st Year and 2nd Sem Collage</option>
                          <option value="College 1st Year 1st Sem">2nd Year and 1st Sem Collage</option>
                          <option value="College 1st Year 2nd Sem">2nd Year and 2nd Sem Collage</option>
                          <option value="College 2nd Year 1st Sem">3rd Year and 1st Sem Collage</option>
                          <option value="College 2nd Year 2nd Sem">3rd Year and 2nd Sem Collage</option>
                          <option value="College 1st Year 1st Sem">4th Year and 1st Sem Collage</option>
                          <option value="College 1st Year 1st Sem">4th Year and 2nd Sem Collage</option>
                      </select>

                  <div>
                      <label for="course" class="block text-gray-700 font-medium">Course</label>
                      <select name="course" id="course" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                          <option value="" disabled selected>Select your course</option>
                          <option value="BSIT">BSIT</option>
                          <option value="BSTM">BSTM</option>
                          <option value="BSCRIM">BSCRIM</option>
                          <option value="BSED">BSED</option>
                          <option value="BSPSYC">BSPSYC</option>
                          <option value="BSCOMENG">BSCOMENG</option>
                      </select>
                  </div>

                  <div>
                      <label for="roles" class="block text-gray-700 font-medium">Role</label>
                      <select name="roles" id="roles"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                          <option value="" disabled selected>Select your role</option>
                          <option value="student">student</option>
                          <option value="teacher">teacher</option>
                          <option value="admin">admin</option>
                          
                      </select>
                  </div>

                  <div>
                      <button type="submit"
                          class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                          Save Student
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</x-admin-layout>
