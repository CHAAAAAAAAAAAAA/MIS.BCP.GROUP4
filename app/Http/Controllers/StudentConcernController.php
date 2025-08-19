<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentConcern; // Import the model

class StudentConcernController extends Controller
{
    public function index()
    {
        $concerns = StudentConcern::with('student')->get(); // Fetch concerns with student details
        return view('admin.auth.students.studentconcern', compact('concerns'));
    }

    public function destroy(StudentConcern $concern)
    {
        $concern->delete();

        return redirect()->back()->with('success', 'Concern deleted successfully.');
    }




    // Method to store a new concern
    public function store(Request $request)
    {
        $request->validate([
            'concern' => 'required|string|max:1000',
        ]);

        StudentConcern::create([
            'student_id' => auth()->user()->id, // Automatically get logged-in student's ID
            'concern' => $request->input('concern'),
        ]);

        return redirect()->back()->with('success', 'Your concern has been submitted.');
    }

}