@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Subject</h1>
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
              
             
              <form method="post" action="{{ url('admin/subject/add') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                

                <div class="form-group col-md-">
                    <label >Subject Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old ('name') }}" name="name" required placeholder="Subject Name">
                    <div style="color:red">{{ $errors->first('name') }}</div>
                  </div>
                  
                  <div class="form-group col-md-">
                    <label >Type <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" value="{{ old ('type') }}" name="type" required placeholder="Type">
                    <div style="color:red">{{ $errors->first('type') }}</div>
                  </div>

                  <div class="form-group col-md-">
                    <label >Status <span style="color: red;">*</span></label>
                    <select class="form-control" name="status">
                      <option value="0">Active</option>
                      <option value="0">Inactive</option>
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