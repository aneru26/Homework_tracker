@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Homework</h1>
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
                <div class="row">

                  <div class="form-group col-md-12">
                    <label >Section <span style="color: red;">*</span> </label>
                    <select class="form-control" required id="getClass"  name="class_id" >
                        <option value="">Select Section</option>
                        @foreach ($getClass as $class)
                        <option value="{{ $class->class_id}}">{{ $class->class_name}}</option>
                        @endforeach
                        <div style="color:red">{{ $errors->first('class_id') }}</div>
                    </select>
                    
                  </div>

                   <div class="form-group col-md-12">
                  <label >Subject</label>
                  <select class="form-control" name="subject_id" id="getSubject" required>
                    <option value="">Select Subject</option>
                   
                  </select>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Homework Date </label>
                    <input type="date" class="form-control" name="homework_date" required placeholder="Homework Date">
                    <div style="color:red" >{{ $errors->first('email')}}</div>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Submission Date </label>
                    <input type="date" class="form-control" name="submission_date" required placeholder="Submission Date">
                    <div style="color:red" >{{ $errors->first('email')}}</div>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Document</label>
                    <input type="file" class="form-control" name="document_file" placeholder="Document">
                    <div style="color:red" >{{ $errors->first('email')}}</div>
                  </div>


                  <div class="form-group col-md-12">
                    <label>Description</label>
                  <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px"></textarea>
                  </div>
               

                </div>
             
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

@section('script')


  <script src="{{ asset ('plugins/summernote/summernote-bs4.min.js') }}"></script>

  <script type="text/javascript">

  $(function ()
  {
    $('#compose-textarea').summernote({
      height: 200
    });

    $('#getClass').change(function(){
      var class_id = $(this).val();
      $.ajax({
        type:"POST",
        url:"{{ url('teacher/ajax_get_subject') }}",
        data : {
          "_token": "{{ csrf_token() }}",
          class_id: class_id,
        },
        dataType: "json",
        success:function(data){
              $('#getSubject').html(data.success);
        }
      });
    });
  });


</script>

@endsection