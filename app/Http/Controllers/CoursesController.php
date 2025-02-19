<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function ViewCourses(){

        $courses = Course::orderby('id','asc')
            ->paginate(10);

        return view('viewCourses', compact('courses'));
    }

    public function AddCourseView(){

        return view('addCourseView');
    }

    public function AddCourse(Request $request){

        $request->validate([
            'name' => 'required',
    
        ],[
            'name.required' => 'Course Name is required',
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->save();

        return redirect('/viewCourses')->with('message','Course Added Successfully');

    }

    public function EditCourseView($id){

        $course = Course::find($id);

        return view('editCourseView', compact('course'));

    }

    public function EditCourse(Request $request){

        $request->validate([
            'name' => 'required',

        ],[
            'name.required' => 'Course Name is required',
        ]);

        Course::where(['id' => $request->id])->update([
            'name' => $request->name
        ]);

        return redirect('/viewCourses')->with('message','Course Updated Successfully');

    
    }

    public function DeleteCourse(Request $request){

        // dd($request->all());

        $id = $request->id;

        $course = Course::find($id);
    if ($course) {
        $course->students()->detach();

        $course->delete();

        return redirect('/viewCourses')->with('message', 'Course deleted successfully');
    }

    return redirect('/viewCourses')->with('message', 'Course not found');
    }
}
