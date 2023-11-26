@extends('layouts.app')  

@section('content')
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Class Teacher  (Total : {{ $getRecord->total() }})</h1>
          </div>

          <div class="col-sm-6" style="text-align:right;">
            <a href="{{ url('admin/assign_class_teacher/add')}}" class="btn btn-primary">Add New Assign Section Teacher</a>
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
                <h3 class="card-title">Assign Section Teacher</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow:auto; " >
                <table class="table table-striped" id="myTable">
                  <thead>   
                    <tr>
                     
                      <th >Id</th>
                      <th>Section</th>
                      <th>Subject</th>
                      <th>Teacher FName</th>
                      <th>Teacher LName</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th >Created Date</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value )
                      <tr>
                       <td>{{ $value->id }}</td>
                       <td>{{ $value->class_name }}</td>
                       <td>{{ $value->subject_name }}</td>
                       <td>{{ $value->teacher_name }} </td>
                       <td>{{ $value->teacher_last_name }} </td>
                       <td>
                         @if($value->status == 0)
                           Active
                           @else
                           Inactive
                         @endif
                       </td>
                       <td>{{ $value->created_by_name }}</td>
                       <td>{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                       <td style="min-width: 140px;"> 
                         <div class="btn-group">
                           <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Actions
                           </button>
                           <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{ url('admin/assign_class_teacher/edit/'.$value->id) }}">Edit</a>
                             <a class="dropdown-item" href="{{ url('admin/assign_class_teacher/edit_single/'.$value->id) }}">Edit Single</a>
                             <a class="dropdown-item" href="{{ url('admin/assign_class_teacher/delete/'.$value->id) }}">Delete</a>
                           </div>
                         </div>
                       </td>
                      </tr>
                    @endforeach
                   </tbody>
                </table>
                <div style="padding: 10px; float:right;">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
              </div>
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