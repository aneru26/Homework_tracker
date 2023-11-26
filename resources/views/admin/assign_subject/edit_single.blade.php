@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit New Assign Subject</h1>
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
              
             
              <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                

                <div class="form-group col-md-">
                    <label >Section <span style="color: red;">*</span></label>
                    <select class="form-control" name="class_id">
                      <option value="">Select Section</option>
                      @foreach ($getClass as $class)
                      <option {{ ($getRecord->class_id == $class->id ) ? 'selected' : '' }} value="{{ $class->id}}">{{ $class->name}}</option>
                      @endforeach
                    </select>
                    
                  </div>

                  <div class="form-group col-md-">
                    <label >Subject Name <span style="color: red;">*</span></label>
                    <select class="form-control" name="subject_id">
                      <option value="">Select Subject</option>
                      @foreach ($getSubject as $subject)
                      <option {{ ($getRecord->subject_id == $subject->id ) ? 'selected' : '' }} value="{{ $subject->id}}">{{ $subject->name}}</option>
                      @endforeach
                    </select>
                    
                  </div>




                  <div class="form-group col-md-">
                    <label >Status <span style="color: red;">*</span></label>
                    <select class="form-control" name="status">
                      <option {{ ($getRecord->status == 0 ) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ ($getRecord->status == 1 ) ? 'selected' : '' }}  value="1">Inactive</option>
                    </select>
                    
                  </div>

                

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
             </div>
         
          </div>
          
        </div>
        
</div>
    </section>
  
  </div>


@endsection