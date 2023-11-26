@extends('layouts.app')  

@section('content')
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Class & Subject </h1>
          </div>

          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       

          @include(' _message')

            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Class & Subject </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow:auto; " >
                <table class="table table-striped" id="myTable">
                  <thead>   
                    <tr>
                     
                      
                      <th>Section</th>
                      <th>Subject Name</th>
                      <th>Subject Type</th>
                      <th >Created Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value )
                        <tr>
                    
                            <td>{{ $value->class_name }}</td>
                            <td>{{ $value->subject_name }}</td>
                            <td>{{ $value->subject_type }}</td>
                            <td>{{  date('m-d-Y  H:i A', strtotime($value->created_at)) }}</td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </section> 
  </div>
  <!-- /.content-wrapper -->
 

@endsection