<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentQualification;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function ViewStudents(Request $request){

        try{

            $search = $request->search;

            $students = Student::orderby('id','desc');

            $courses = Course::orderby('id','desc')->get();

            if($search){
                $students = $students->where(function($query) use ($search){
                    $query->where('name','like','%'.$search.'%');
                    
                });
            }

            $students = $students->paginate(10);

            return view('viewStudents',compact('students','courses','search'));

        }catch (Exception $e) {

            return redirect()->back()->with('error','Something went wrong');

        }
    }

    public function AddStudentView(){

        $courses = Course::orderby('id','desc')->get();

        return view('createView',compact('courses'));
    }

    public function AddStudent(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'qualification' => 'required',
            'course' => 'required',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email already exists',
            'qualification.required' => 'Qualification is required',
            'course.required' => 'Course is required',
        ]);

        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->isActive = 1;
        $student->save();

        $qualification = new StudentQualification();
        $qualification->student_id = $student->id;
        $qualification->qualification = $request->qualification;
        $qualification->save();

        $studentCourse = new StudentCourse();
        $studentCourse->student_id = $student->id;
        $studentCourse->course_id = $request->course;
        $studentCourse->save();

        return redirect('/')->with('message','Student added successfully');
    }

    public function EditStudentView($id){

        $student = Student::find($id);

        $courses = Course::orderby('id','desc')->get();

        return view('editView',compact('student','courses'));
    }

    public function EditStudent(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'qualification' => 'required',
            'course' => 'required',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'qualification.required' => 'Qualification is required',
            'course.required' => 'Course is required',
        ]);


        Student::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        StudentQualification::where('student_id',$request->id)->update([
            'qualification' => $request->qualification,
        ]);

        StudentCourse::where('student_id',$request->id)->update([
            'course_id' => $request->course,
        ]);

        return redirect('/')->with('message','Student updated successfully');


    }

    public function DeleteStudent(Request $request)
    {
        

        $id = $request->id;

        $student = Student::find($id);
            if ($student) {

        $student->qualifications()->delete();

        $student->courses()->detach();

        $student->delete();

        return redirect('/')->with('message', 'Course deleted successfully');
    }
    
    }

    public function AnotherCourse(Request $request){

        $studentCourse = new StudentCourse();
        $studentCourse->student_id = $request->id;
        $studentCourse->course_id = $request->course;
        $studentCourse->save();

        return redirect('/')->with('message','Course added successfully');


    }

    public function ViewStudentsAPI(){

        $students = Student::orderby('id','desc')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Students fetched successfully',
            'data' => $students
        ]);
    }
}
