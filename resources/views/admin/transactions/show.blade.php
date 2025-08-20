<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Account Summary
        </h2>
    </x-slot>

    {{-- 🔹 PDF Download Button --}}
    <div class="px-6">
        <div class="flex justify-end">
            <a href="{{ route('admin.student.summary.pdf', $student->id) }}"
                class="inline-flex items-center px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded hover:bg-slate-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
                Download PDF
            </a>
        </div>
    </div>


    <div class="p-6 space-y-6">
        {{-- 🔹 Student Info --}}
        <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    class="w-6 h-6 text-gray-600" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" 
                    />
                </svg>
                Student Information
            </h3>

            <div class="text-sm space-y-2">
                <p><strong>Student Number:</strong> {{ $student->student_number }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Program:</strong> {{ $student->program }}</p>
                <p><strong>Year Level:</strong> {{ $student->year_level }}</p>
                <p><strong>Section:</strong> {{ $student->section }}</p>
                <p><strong>Schedule:</strong> {{ $student->schedule }}</p>
            </div>
        </div>

        {{-- 🔹 Statement of Account --}}
        <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold mb-4">Statement of Account</h3>

            <table class="w-full text-sm">
                <tbody class="divide-y">
                    {{-- Tuition --}}
                    <tr>
                        <td class="py-2 font-medium">Tuition</td>
                        <td class="py-2">13 Units x ₱500</td>
                        <td class="py-2 text-right">₱6,500</td>
                    </tr>
                    <tr>
                        <td class="py-2"></td>
                        <td class="py-2">Paid by EJA Foundation</td>
                        <td class="py-2 text-right">₱6,500</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="py-2 font-medium text-right">Balance</td>
                        <td class="py-2 text-right">₱0</td>
                    </tr>

                    {{-- Miscellaneous Fees --}}
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-2 font-semibold">Miscellaneous Fees</td>
                    </tr>
                    <tr><td></td><td>Registration</td><td class="text-right">₱400</td></tr>
                    <tr><td></td><td>Library</td><td class="text-right">₱650</td></tr>
                    <tr><td></td><td>Athletics & Sports Dev. Fee</td><td class="text-right">₱500</td></tr>
                    <tr><td></td><td>Medical & Dental</td><td class="text-right">₱400</td></tr>
                    <tr><td></td><td>Cultural Fee</td><td class="text-right">₱400</td></tr>
                    <tr><td></td><td>Guidance & Counseling</td><td class="text-right">₱400</td></tr>
                    <tr><td></td><td>Energy Fee</td><td class="text-right">₱1,000</td></tr>
                    <tr><td></td><td>Laboratory Fee</td><td class="text-right">₱600</td></tr>
                    <tr><td></td><td>Community & Students Dev. Fee</td><td class="text-right">₱600</td></tr>
                    <tr><td></td><td>Insurance</td><td class="text-right">₱25</td></tr>

                    <tr>
                        <td colspan="2" class="py-2 font-medium text-right">Total Miscellaneous</td>
                        <td class="py-2 text-right">₱4,975</td>
                    </tr>

                    {{-- Enrollment Fee --}}
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-2 font-semibold">Enrollment Fee</td>
                    </tr>

                    {{-- Supplementary Fee --}}
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-2 font-semibold">Supplementary Fee</td>
                    </tr>
                    <tr><td></td><td>School ID with Lace</td><td class="text-right">₱350</td></tr>

                    {{-- Other Fee --}}
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-2 font-semibold">Other Fee</td>
                    </tr>
                    <tr><td></td><td>Medical Laboratory Fee</td><td class="text-right">₱500</td></tr>

                    {{-- Payments --}}
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-2 font-semibold">Less Payment</td>
                    </tr>
                    <tr><td></td><td>O.R: 054796A</td><td class="text-right">₱500</td></tr>
                    <tr><td></td><td>O.R: 054796A</td><td class="text-right">₱1,000</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
