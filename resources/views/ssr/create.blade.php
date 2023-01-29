@extends('ssr.master')

@section('main')
<div class="container">

  <div class="card card-body p-5">
    <div class="row mb-2">
      <div class="col-md-12 bg-light align-items-center py-4 mb-2 mx-auto">
        <div class="d-flex justify-content-between">
          <h5>
           <i class="fa fa-server"></i> Server Side Rendering
          </h5>
          <p>{{ Session::get('msg')}}</p>
          <a href="{{ route('student.index')}}" class="btn btn-sm btn-success rounded-0"> <i class="fa fa-gear pe-1"></i>Manage</a>
        </div>
      </div>
    </div>
  
  
    <div class="row">
      <div class="col-md-5 mx-auto">
        <div class="card rounded-0 border-dark shadow">
          <div class="card-header">
            <h4 class="text-center">Add New Student</h4>
          </div>
  
          <div class="card-body">
            <form action="{{ route('student.store')}}" method="post">
              @csrf
              <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name"  placeholder="Enter name">
              </div>

              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
              </div>

              <div class="form-group mb-3">
                <label for="email">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
              </div>

              <button type="submit" class="btn btn-sm btn-primary">Create</button>
            </form>
  
          </div>
        </div>
  
      </div>
    </div>
  </div>

</div>
  
@endsection