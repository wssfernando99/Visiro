<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [StudentController::class, 'ViewStudents']);
Route::get('/createView', [StudentController::class, 'AddStudentView']);

Route::post('/addStudent', [StudentController::class, 'AddStudent']);
Route::get('/editView/{id}', [StudentController::class, 'EditStudentView']);

Route::put('/editStudent', [StudentController::class, 'EditStudent']);

Route::post('/deleteStudent', [StudentController::class, 'DeleteStudent']);

Route::get('/viewCourses', [CoursesController::class, 'ViewCourses']);