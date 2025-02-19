@extends('layout')
@section('content')

<div class="container-fluid p-5">

<div class="row">

    <div class="col-md-12 mb-3"><h4>Add New Student</h4></div>
    <div class="col-md-12">



        <form action="{{ url('/editStudent') }}" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" class="form-control"  name="id" id="id" value="{{ $student->id }}" hidden/>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="name" id="name" value="{{ old('name', $student->name ?? '') }}"/>
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control"  name="email" id="email" value="{{ old('email', $student->email ?? '') }}"/>
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="">Qualification<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="qualification" id="qualification" value="{{ old('qualification',  $student->qualifications->first()->qualification ?? '') }}"/>
                        @error('qualification')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="col-md-6 mb-3">
                    <label class="form-label" for="">Course<span class="text-danger">*</span></label>
                    <select class="form-control" name="course" id="course" >
                        <option value="">--Select a Course--</option>
                        @foreach ($courses as $course )
                        <option value="{{ $course->id }}" 
                            {{ old('course', $student->courses->first()->id ?? '') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                        </option>
                        @endforeach
                        
                    </select>
                    @error('course')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>

          
           
                
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ url("/") }}" class="btn btn-secondary">Back</a>
        
        </form>
        
    </div>
</div>
</div>

@endsection