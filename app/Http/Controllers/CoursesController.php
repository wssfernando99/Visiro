<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class CoursesController extends Controller
{
    public function ViewCourses(){

        try{

            $courses = Course::orderby('id','asc')
            ->paginate(10);

        return view('viewCourses', compact('courses'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }

        
    }

    public function AddCourseView(){

        return view('addCourseView');
    }

    public function AddCourse(Request $request){

        try{

            $request->validate([
                'name' => 'required',
        
            ],[
                'name.required' => 'Course Name is required',
            ]);
    
            $course = new Course();
            $course->name = $request->name;
            $course->save();
    
            return redirect('/viewCourses')->with('message','Course Added Successfully');

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function EditCourseView($id){

        try{

            $course = Course::find($id);

        return view('editCourseView', compact('course'));

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }

    }

    public function EditCourse(Request $request){

        try{

            $request->validate([
                'name' => 'required',
    
            ],[
                'name.required' => 'Course Name is required',
            ]);
    
            Course::where(['id' => $request->id])->update([
                'name' => $request->name
            ]);
    
            return redirect('/viewCourses')->with('message','Course Updated Successfully');

        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    
    }

    public function DeleteCourse(Request $request){

       try{

        $id = $request->id;

        $course = Course::find($id);
            if ($course) {
                $course->students()->detach();

                $course->delete();

                return redirect('/viewCourses')->with('message', 'Course deleted successfully');
            }

        return redirect('/viewCourses')->with('message', 'Course not found');
       }catch(Exception $e){
        return redirect()->back()->with('error','Something went wrong');
        }

        
    }
}
