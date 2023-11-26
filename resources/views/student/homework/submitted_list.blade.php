@extends('layouts.app')  

@section('content')
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Submitted Homework</h1>
          </div>

          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
         </div>

          @include(' _message')

            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submitted Homework List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow:auto; " >
                <table class="table table-striped" id="myTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Section</th>
                      <th>Subject</th>
                      <th>Homework Date</th>
                      <th>Submission Date</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th >Created Date</th>
                      <th>Submitted Document</th>
                      <th>Submitted Description</th>
                      <th >Submitted Created Date</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($getRecord as $value )
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->subject_name }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}</td>
                      <td>
                        @if(!empty($value->getHomework->getDocument()))
                          <a href="{{ $value->getHomework->getDocument() }}" class="btn btn-primary" target="_blank">View</a>
                        @endif
                      </td>
                      <td>{!! $value->getHomework->description !!}</td>
                      <td>{{ date('d-m-Y', strtotime($value->getHomework->created_at)) }}</td>
                      <td>
                        @if(!empty($value->getDocument()))
                          <a href="{{ $value->getDocument() }}" class="btn btn-primary" target="_blank">View</a>
                        @endif
                      </td>

                      <td>{!! $value->description !!}</td>
                      <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    
                    </tr>
                     
                   @empty
                     
                   @endforelse
                  
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