@extends('layout').


@section('content')

<div class="container-fluid p-5">



    <div class="row">

        <div class="col-md-12 mb-3 d-flex justify-content-between">
            <a href="{{ url('/createView') }}" class="btn btn-primary">Add Students</a>
            <a href="{{ url('/vewCourses') }}" class="btn btn-primary">View Courses</a>
          </div>

      

      @if (session()->has('message'))
          <div class="col-md-4">
            <div class="alert alert-success alert-dismissible" role="alert">
                <h6 class="alert-heading d-flex align-items-center mb-1">Completed:</h6>
                <p class="mb-0">{{ session()->get('message') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
          </div>
      @endif

      @foreach ($errors->all() as $error)
          <div class="col-md-4">
              <div class="alert alert-danger alert-dismissible" role="alert">
                  <h6 class="alert-heading d-flex align-items-center mb-1">Error!!</h6>
                    <p class="mb-0">{{ $error }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
              </div>
            </div>
      @endforeach

        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Student Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($students as $student)

                  <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ url('/editView/'.$student->id) }}" class="btn btn-secondary">Edit</a>
                        <a href="{{ url('/vewCourses') }}" class="btn btn-secondary">add another course</a>
                        <button class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="{{ $student->id }}">Delete</button>

                    </td>
                 
                  </tr>
                    
                  @endforeach
                  
              
                 
                </tbody>
              </table>
              {{ $students->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Delete Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/deleteStudent') }}" class="needs-validation" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="text" class="form-control" id="id" name="id" hidden/>
                    <div class="row">
                        <div class="mb-3">
                            <h5 >Are you sure you want to delete this Student?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        No
                    </button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
  
            
        </div>
    </div>
  </div>

  <script>
  $(document).ready(function() {

  console.log('sds');
      $('#delete-modal').on('show.bs.modal', function(event) {
          let button = $(event.relatedTarget);
          let id = button.data('id');


          let modal = $(this);
          modal.find('.modal-body #id').val(id);
      });
  });
</script>


 






{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}




@endsection
