<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function ViewCourses(){

        $courses = Course::all();
        return view('courses.view', compact('courses'));
    }
}
