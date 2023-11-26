@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Assign Subject</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
           
            <div class="card card-primary">
              
             
              <form method="post" action="{{ url('admin/assign_subject/add') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                

                <div class="form-group col-md-">
                    <label >Class Name <span style="color: red;">*</span></label>
                    <select class="form-control" name="class_id">
                      <option value="">Select Class</option>
                      @foreach ($getClass as $class)
                      <option value="{{ $class->id}}">{{ $class->name}}</option>
                      @endforeach
                    </select>
                    
                  </div>

                  {{-- <div class="form-group col-md-">
                    <label>Subject Name </label>
                    @foreach($getSubject as $subject)
                        <div>
                            <label style="font-weight: normal;">
                                <input type="checkbox"> {{ $subject->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                 --}}

                 <div class="form-group col-md-">
                  <label>Subject Name <span style="color: red;">*</span></label>
                  @foreach($getSubject as $subject)
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="subject_id[]" value="{{ $subject->id }}">
                          {{ $subject->name }}
                      </div>
                  @endforeach
              </div>

                  <div class="form-group col-md-">
                    <label >Status <span style="color: red;">*</span></label>
                    <select class="form-control" name="status">
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
                    
                  </div>

                

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
             </div>
         
          </div>
          
        </div>
        
</div>
    </section>
  
  </div>


@endsection