<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'ViewStudentsAPI']);
Route::post('/addStudent', [StudentController::class, 'AddStudentAPI']);
Route::put('/editStudent', [StudentController::class, 'EditStudentAPI']);
Route::get('/getStudent/{id}', [StudentController::class, 'GetStudentAPI']);


