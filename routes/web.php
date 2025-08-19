<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentConcernController;
use App\Http\Controllers\Auth\LoginOtpController;
use App\Http\Controllers\Admin\Auth\LoginController;



use App\Http\Controllers\DashboardController;

Route::get('/', function (){
    return redirect('login');
});

Route::get('/userdashboard', function () {
    return view('userdashboard');
})->name('userdashboard');



Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/admin/auth/student/create', [StudentController::class, 'create'])->name('admin.auth.student.create');

Route::get('/student/createe', [StudentController::class, 'createe'])->name('student.createTeacher');
Route::get('/student/createee', [StudentController::class, 'createee'])->name('student.createshs');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::post('/student/teacher', [StudentController::class, 'teacherstore'])->name('teacher.store');
Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');

Route::get('/student/{student}/teacher-edit',[StudentController::class, 'editTeacher'])->name('student.teacheredit');
Route::get('/student/teacher/{student}/edit', [StudentController::class, 'editshs'])->name('student.shsedit');
Route::get('/admin/auth/student/teacher', [StudentController::class, 'teachersearch'])->name('admin.auth.student.teacher');

Route::get('/admin/auth/student/teacher', [StudentController::class, 'teachersearch'])
    ->name('admin.auth.student.teacher');

    Route::get('/admin/auth/students/shs', [StudentController::class, 'shsSearch'])->name('admin.auth.students.shs');

Route::get('/admin/auth/student/college', [StudentController::class, 'collegesearch'])
    ->name('admin.auth.student.college');



Route::put('/student/{student}/update', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{student}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/dashboard', [StudentController::class, 'scount'])->name('dashboard');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/create-teacher', [StudentController::class, 'createTeacher'])->name('createTeacher');
});


Route::get('/admin/auth/student/shs', [StudentController::class, 'indexSHS'])->name('admin.auth.student.shs');

Route::get('/admin/auth/student/teacher', [StudentController::class, 'teacher'])->name('admin.auth.student.teacher');

Route::get('/students/college', [StudentController::class, 'indexCollege'])->name('students.college');

Route::get('/students/senior-high', [StudentController::class, 'indexSeniorHigh'])->name('students.senior_high');


Route::get('/dashboard', function () {
    return view('dashboard'); // Blade file for user dashboard
})->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // Blade file for admin dashboard
})->name('admin.dashboard');


Route::get('/admin/auth/student/academicrecords', [StudentController::class, 'academicrecords'])->name('admin.auth.student.academicrecords');

Route::get('/academicrecords', [StudentController::class, 'searchacademicrecords'])->name('students.academicrecords');

Route::get('/students/studentconcern', function () {
    return view('students.studentconcern'); // Blade file for admin dashboard
})->name('students.studentconcern');

Route::post('/students/studentconcern', [StudentConcernController::class, 'store'])->name('student.concerns.store');

Route::get('/admin/auth/students/studentsconcern', function () {
    return view('admin.auth.students.studentconcern');
})->name('admin.auth.students.studentsconcern');

Route::get('/admin/auth/students/studentconcern', [StudentConcernController::class, 'index'])->name('admin.auth.students.studentsconcern');
Route::post('/admin/auth/students/studentconcern', [StudentConcernController::class, 'store'])->name('student.concerns.store');
Route::delete('/concerns/{concern}', [StudentConcernController::class, 'destroy'])
    ->name('concerns.destroy');

//try lang to

Route::get('/admin/auth/student/index', [StudentController::class, 'index'])->name('admin.auth.student.index');

Route::get('/admin/students/college-search', [StudentController::class, 'collegeSearch'])->name('admin.students.collegeSearch');

Route::get('/admin/students/shs-search', [StudentController::class, 'shsSearch'])->name('admin.students.shsSearch');

Route::get('/admin/auth/student/create', [StudentController::class, 'create'])->name('admin.auth.student.create');

Route::post('/admin/auth/student/store', [StudentController::class, 'studentadminstore'])->name('admin.auth.student.store');

Route::get('/admin/students/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
Route::delete('/admin/students/destroy/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
Route::put('/admin/students/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');

// gago
Route::delete('/admin/teachers/destroy/{id}', [StudentController::class, 'destroyTeacher'])
    ->name('admin.teachers.destroy');

Route::get('/students/teacher', [StudentController::class, 'teacherView'])->name('student.teacher');

//

Route::get('/Module 1', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('Module 1');

Route::get('/Module 2', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('Module 2');

Route::get('/Module 3', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('Module 3');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// OTP verification
Route::get('/admin/otp-verify', [LoginController::class, 'showOtpForm'])->name('admin.otp.verify');
Route::post('/admin/otp-check', [LoginController::class, 'verifyOtp'])->name('admin.otp.check');


//VIEW STUDENTS
// View student details
Route::get('/admin/students/{id}', [StudentController::class, 'show'])->name('admin.students.show');



require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
