<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StudentController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users

        return view('admin.auth.students.index', compact('users'));
    }

    public function indexSHS()
    {
        $students = Student::all();
        return view('students.shs', ['students' => $students]);
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
    
    

    public function create(){
        return view('students.create');
    }

    public function createe()
    {
        return view('students.createTeacher');
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
            'roles' => 'required'
        ]);

        $newStudent = Student::create($data);

        return redirect(route('student.index'));
    }


    public function edit(Student $student){
        return view('students.edit', ['student' => $student]);
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
            'section' => 'required|string|max:255',
        ]);

        $student = User::findOrFail($id);

        $student->update($data);

        return redirect()->route('admin.students.edit', $id)->with('success', 'Student information updated successfully!');
    }

    public function destroy(Student $student){
        $student->delete();
        return redirect(route('student.index'))->with('success', 'Student Deleted Successfully');
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
                ->orWhere('section', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // ✅ Ensure only SHS students (Grade-level) are fetched
        $users = $query->where('year_level', 'LIKE', 'Grade%')
                    ->whereIn('program', ['TVL', 'STEM', 'ABM', 'HUMSS', 'GAS'])
                    ->get();

        // 🔍 Debug the results
        dd($users); // ✅ Put this here before returning the view

        return view('admin.auth.students.shs', compact('users'));
    }

    public function collegesearch(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('student_number', 'LIKE', "%{$searchTerm}%")
                ->orWhere('program', 'LIKE', "%{$searchTerm}%")
                ->orWhere('section', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // ✅ Ensure only college programs are included
        $users = $query->whereIn('program', ['BSBA', 'BSOA', 'BSIT', 'BSCpE', 'BSTM', 'BSCrim', 'BSPsy', 'BLIS'])
                    ->whereIn('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year'])
                    ->get();

        return view('admin.auth.students.index', compact('users'));
    }


    public function searchacademicrecords(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('id', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        $users = $query->get();

        return view('students.academicrecords', compact('users'));
    }

    public function searchacademicrecordsadmin(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('id', 'LIKE', "%{$searchTerm}%")
                ->orWhere('program', 'LIKE', "%{$searchTerm}%")
                ->orWhere('section', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        $users = $query->get();

        return view('admin.dashboard', compact('users'));
    }

    public function downloadPdf($id)
    {
        $student = User::findOrFail($id);
        $pdf = Pdf::loadView('admin.students.summary-pdf', compact('student'));

        return $pdf->download("student_{$student->id}_summary.pdf");
    }

}
