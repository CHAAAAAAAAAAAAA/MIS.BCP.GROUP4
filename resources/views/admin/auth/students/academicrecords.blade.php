<x-admin-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Academic Records') }}
      </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Student Records</h3>

          <div class="overflow-y-auto max-h-300 border border-gray-300 rounded-lg shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal sticky top-0 z-10">

              <tr>
                <th class="px-4 py-2">Student ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Course</th>
                <th class="px-4 py-2">Grade</th>
              </tr>
            </thead>
              <tbody>
                
                  <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-4 py-2">123</td>
                    <td class="px-4 py-2">Jerome Villaruel</td>
                    <td class="px-4 py-2">BSIT</td>
                    <td class="px-4 py-2">95%</td>
                  </tr>

                  <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-4 py-2">456</td>
                    <td class="px-4 py-2">Charlie Llorico</td>
                    <td class="px-4 py-2">BSIT</td>
                    <td class="px-4 py-2">95%</td>
                  </tr>
                
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
