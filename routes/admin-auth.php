<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\StudentController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin/auth')->middleware('auth:admin')->group(function () {
  Route::get('student/create', [StudentController::class, 'create'])->name('admin.auth.student.create');
  Route::get('student/createee', [StudentController::class, 'createee'])->name('admin.auth.student.createshs');
  Route::get('student/createe', [StudentController::class, 'createe'])->name('admin.auth.student.createTeacher');
});




Route::prefix('admin/auth')->middleware('auth:admin')->group(function () {
  Route::get('student/index', [StudentController::class, 'index'])->name('admin.auth.student.index');
});

Route::prefix('admin/auth')->middleware('auth:admin')->group(function () {
  Route::get('student/indexSHS', [StudentController::class, 'indexSHS'])->name('admin.auth.student.indexSHS');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

  Route::get('/dashboard', [StudentController::class, 'scount'])->name('admin.dashboard');


    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');

    Route::get('/students/shs', [StudentController::class, 'indexSHS'])->name('admin.auth.student.shs');

});

Route::get('/admin/auth/student/teacher', [StudentController::class, 'teachersearch'])
    ->name('admin.auth.student.teacher');

Route::get('/admin/auth/student/seniorhigh', [StudentController::class, 'seniorHighSearch'])
    ->name('admin.auth.student.seniorhigh');

    Route::get('/admin/auth/student/college', [StudentController::class, 'collegesearch'])
    ->name('admin.auth.student.college');


//

    Route::prefix('admin')->middleware('auth:admin')->group(function () {
      Route::get('/edit-profile', [\App\Http\Controllers\ProfileController::class, 'editAdmin'])->name('profile.adminedit');
      Route::patch('/edit-profile', [\App\Http\Controllers\ProfileController::class, 'updateAdmin'])->name('profile.adminupdate');
  });


    Route::prefix('admin')->middleware('auth:admin')->group(function () {
      Route::patch('/change-password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.adminpasswordupdate');
      Route::delete('/delete-account', [\App\Http\Controllers\ProfileController::class, 'deleteAdmin'])->name('profile.admindelete');
  });

//
