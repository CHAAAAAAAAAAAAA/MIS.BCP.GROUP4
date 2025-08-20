<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

use Psy\TabCompletion\Matcher\FunctionsMatcher;

use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $users = User::whereIn('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year'])
                    ->whereIn('program', ['BSBA', 'BSOA', 'BSIT', 'BSCpE', 'BSTM', 'BSCrim', 'BSPsy', 'BLIS'])
                    ->get();

    return view('admin.auth.students.index', compact('users'));

    }



    public function scount() {
        $studentCount = Student::where('roles', 'LIKE', '%student%')->count();
        $sstudentCount = User::whereNull('email_verified_at')->count();
        $adminCount = Admin::whereNotNull('name')->where('name', '!=', '')->count();
        $teacherCount = Student::where('roles', 'LIKE', '%teacher%')->count();
    
        $allStudentRoles = Student::where(function ($query) {
            $query->where('roles', 'LIKE', '%admin%')
                    ->orWhere('roles', 'LIKE', '%teacher%')
                    ->orWhere('roles', 'LIKE', '%student%');
        })->count();
    
        $times = ['8:00 AM - 10:00 AM', '10:30 AM - 12:30 PM', '1:00 PM - 3:00 PM', '3:30 PM - 5:30 PM'];
        $days = ['Monday & Wednesday', 'Tuesday & Thursday', 'Wednesday & Friday', 'Monday to Friday'];
    
        $users = User::whereNull('email_verified_at')->get()->map(function ($user) use ($times, $days) {
            $user->schedule = $days[array_rand($days)] . ' | ' . $times[array_rand($times)];
            return $user;
        });
    
        $allpersonCount = $adminCount + $allStudentRoles + $sstudentCount;
    
        return view('admin.dashboard', compact(
            'studentCount',
            'adminCount',
            'teacherCount',
            'allpersonCount',
            'users',
            'sstudentCount',
        ));
    }
    

    public function create()
    {
        return view('admin.auth.students.create'); // ✅ Ensure this matches your file structure
    }

    public function createe()
    {
        return view('students.createe');
    }

    public function createee()
    {
        return view('students.createshs');
    }


    public function store(Request $request){
        $data = $request->validate([
            'student_number' => 'required|numeric',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'year_level' => 'nullable',
            'course' => 'nullable',
            'strand' => 'nullable',
            'roles' => 'required'
        ]);

        $newStudent = Student::create($data);

        return redirect(route('student.index'));
    }

    public function studentadminstore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'program' => 'required|string',
            'year_level' => 'required|string',
            'semester' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ✅ Hash the password before saving
        $data['password'] = bcrypt($data['password']);

        // 🎯 Assign a random section
        $sections = ['3101', '3102', '4101', '4102'];
        $data['section'] = Arr::random($sections);

        // 🎯 Assign a random schedule (3 unique time slots)
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $times = ['8:00 AM - 10:00 AM', '10:30 AM - 12:30 PM', '1:00 PM - 3:00 PM', '3:30 PM - 5:30 PM'];

        $finalSchedules = [];
        while (count($finalSchedules) < 3) {
            $selectedDays = Arr::random($weekdays, 3);
            $schedule = [];

            foreach ($selectedDays as $day) {
                $schedule[] = "$day | " . Arr::random($times);
            }

            sort($schedule); // Ensure consistency
            if (!in_array($schedule, $finalSchedules)) {
                $finalSchedules[] = $schedule;
            }
        }

        // Store the schedules as a **compact JSON string**
        $data['schedule'] = json_encode(array_map(fn($s) => implode(", ", $s), $finalSchedules), JSON_UNESCAPED_UNICODE);

        // ✅ Save student record with random section and schedule
        $newStudent = User::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Student registered successfully with section: ' . $data['section']);
    }




    public function teacherstore(Request $request)
    {
        $data = $request->validate([
            'student_number' => 'required|numeric',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'year_level' => 'nullable',
            'roles' => 'required'
        ]);

        Student::create($data);

        return redirect()->route('student.teacher')->with('success', 'Teacher created successfully.');
    }


    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.auth.students.edit', compact('student')); // ✅ Make sure this matches your Blade path
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'program' => 'required|string',
            'year_level' => 'required|string',
            'semester' => 'required|string',
            'section' => 'required|string|max:255', // Add section to the validation rules
        ]);

        $student = User::findOrFail($id);

        $student->update($data); // Section is now included in the $data array

        return redirect()->route('admin.students.edit', $id)->with('success', 'Student information updated successfully!');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Student deleted successfully!');
    }

    public function destroyTeacher($id)
    {
        $teacher = Student::findOrFail($id); // or Teacher::findOrFail($id)
        $teacher->delete();

        return redirect()->back()->with('success', 'Teacher deleted successfully.');
    }

    public function teacherView()
    {
        $students = Student::where('roles', 'teacher')->get(); // or use str_contains if roles is a string

        return view('students.teacher', compact('students'));
    }


    public function indexCollege()
    {
        $students = Student::where('year_level', 'LIKE', '%College%')->get();
        return view('students.college', ['students' => $students]);
    }

    public function indexSeniorHigh()
    {
        $students = Student::where('year_level', 'LIKE', '%Senior High%')->get();
        return view('students.senior_high', ['students' => $students]);
    }

    public function teacher()
    {
        // Fetch only the students with the role 'teacher'
        $students = Student::where('roles', 'LIKE', '%teacher%')->get();

        return view('students.teacher', compact('students'));
    }
    

    public function editTeacher(Student $student)
    {
        return view('students.teacheredit', compact('student'));
    }

    public function editshs(Student $student)
    {
        return view('students.shsedit', compact('student'));
    }

    public function teachersearch(Request $request)
{
    $search = trim($request->input('search'));

    $students = Student::where('roles', 'like', '%teacher%')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('student_number', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");

                if (str_contains($search, ' ')) {
                    $parts = explode(' ', $search, 2);
                    $firstName = $parts[0];
                    $lastName = $parts[1] ?? '';

                    $q->orWhere(function ($query) use ($firstName, $lastName) {
                        $query->where('first_name', 'like', "%{$firstName}%")
                            ->where('last_name', 'like', "%{$lastName}%");
                    });
                }
            });
        })
        ->get();

        return view('students.teacher', compact('students'));
}

    public function shsSearch(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = trim($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('student_number', 'LIKE', "%{$searchTerm}%")
                ->orWhere('program', 'LIKE', "%{$searchTerm}%") // 🔍 Ensure program search works
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // ✅ Ensure TVL & ICT students are included
        $users = $query->whereIn('year_level', ['Grade 11', 'Grade 12'])
                    ->whereIn('program', ['TVL', 'STEM', 'ABM', 'HUMSS', 'GAS', 'ICT'])
                    ->get();

        return view('admin.auth.students.shs', compact('users')); // Pass users to view
    }


    public function collegeSearch(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = trim($request->search);

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('student_number', 'LIKE', "%{$searchTerm}%")
                ->orWhere('program', 'LIKE', "%{$searchTerm}%")
                ->orWhere('section', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // ✅ Exclude SHS students completely and filter only college-level programs
        $users = $query->whereIn('program', ['BSBA', 'BSOA', 'BSIT', 'BSCpE', 'BSTM', 'BSCrim', 'BSPsy', 'BLIS'])
                    ->whereIn('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year'])
                    ->get();

        return view('admin.auth.students.index', compact('users'));
    }


    public function academicrecords(){
        $users = User::all(); // Fetch all users

        return view('students.academicrecords', compact('users')); // Pass users to the view
    }

    public function searchacademicrecords(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('student_number', 'LIKE', "%{$searchTerm}%")
                ->orWhere('program', 'LIKE', "%{$searchTerm}%")
                ->orWhere('section', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        $users = $query->get();

        return view('students.academicrecords', compact('users'));
    }


//VIEWS STUDENTS

    public function show($id)
    {
        $student = User::findOrFail($id);

        return response()->json($student); // Return as JSON for SweetAlert
    }



    public function downloadPdf($id)
    {
        $student = User::findOrFail($id);
        $pdf = Pdf::loadView('admin.students.summary-pdf', compact('student'));

        return $pdf->download("student_{$student->id}_summary.pdf");
    }


}
