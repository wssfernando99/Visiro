@extends('layout')
@section('content')

<div class="container-fluid p-5">

<div class="row">

    <div class="col-md-12 mb-3"><h4>Add New Course</h4></div>
    <div class="col-md-12">



        <form action="{{ url('/editCourse') }}" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $course->id }}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="name" id="name" value="{{ old('name', $course->name ?? '') }}"/>
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    
                </div>

          
           
                
                <button type="submit" class="btn btn-primary">save changes</button>
                <a href="{{ url("/viewCourses") }}" class="btn btn-secondary">Back</a>
        
        </form>
        
    </div>
</div>
</div>

@endsection