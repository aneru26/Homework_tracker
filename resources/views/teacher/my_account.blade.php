@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit My Account</h1>
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
           @include('_message')
            <div class="card card-primary">
              
             
              <form method="post" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">
                <div class="form-group">
                    <label >Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old ('name',$getRecord->name) }}" required placeholder="Name">
                  </div>

                  <div class="form-group">
                    <label >Last Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="last_name" value="{{ old ('last_name',$getRecord->last_name) }}" required placeholder="Last Name">
                  </div>

                  <div class="form-group col-md-12">
                    <label >Select year Level <span style="color: red;">*</span> </label>
                    <select class="form-control" required name="program" >
                        <option value="">Select year Level</option>
                        <option {{ (old('program', $getRecord->program) == '1rst year') ? 'selected' : ''}} value="1rst year">1rst year</option>
                        <option {{ (old('program', $getRecord->program) == '2nd year') ? 'selected' : ''}} value="2nd year">2nd year</option>
                        <option {{ (old('program', $getRecord->program) == '3rd year') ? 'selected' : ''}} value="3rd year">3rd year</option>
                        <option {{ (old('program', $getRecord->program) == '4th year') ? 'selected' : ''}} value="4th year">4th year</option>
                    </select>
                    <div style="color:red">{{ $errors->first('program') }}</div>
                  </div>

                  <div class="form-group">
                    <label >Designation<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="designation" value="{{ old ('name',$getRecord->designation) }}" required placeholder="Designation">
                  </div>

                  <div class="form-group">
                    <label >Pofile Pic <span style="color: red;">*</span> </label>
                    <input type="file" class="form-control" name="profile_pic">
                    <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                    @if(!empty($getRecord->getProfilePictureUrl()))
                      <img src="{{ $getRecord->getProfilePictureUrl() }}" style="width: auto;height: 50px;">
                    @endif

      
                  </div>
                  <div class="form-group">
                    <label>Email<span style="color: red;">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ old ('email',$getRecord->email) }}" required placeholder="Email">
                    <div style="color:red" >{{ $errors->first('email')}}</div>
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