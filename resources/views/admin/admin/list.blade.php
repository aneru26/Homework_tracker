@extends('layouts.app')  

@section('content')
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List (Total : {{ $getRecord->total() }}) </h1>
          </div>

          <div class="col-sm-6" style="text-align:right;">
            <a href="{{ url('admin/admin/add')}}" class="btn btn-primary">Add New Admin</a>
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
                <h3 class="card-title">Admin List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow:auto; ">
                <table class="table table-striped" id="myTable">
                  <thead>
                    <tr>
                  
                      <th >Profile Pic</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Designation</th>
                      <th>Email</th>
                      <th >Created Date</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord as $value)
                      <tr>
                        
                        <td>
                          @if(!empty($value->getProfileDirect()))
                          <img src="{{ $value->getProfileDirect() }}" style="height: 50px; width:50px; border-radius: 50px;">
                          @endif
                        <td>{{  $value->name }}</td>
                        <td>{{  $value->last_name }}</td>
                        <td>{{  $value->designation }}</td>
                        <td>{{  $value->email }}</td>
                        <td>{{  date('m-d-Y , H:i A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 140px;"> 
  <div class="btn-group">
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Actions
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ url('admin/admin/show/'.$value->id) }}">Show</a>
      <a class="dropdown-item" href="{{ url('admin/admin/edit/'.$value->id) }}">Edit</a>
      <a class="dropdown-item" href="{{ url('admin/admin/delete/'.$value->id) }}">Delete</a>
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