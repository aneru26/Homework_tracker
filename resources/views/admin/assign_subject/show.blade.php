@extends('layouts.app')  

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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
                

                <div class="text-center">
                    
                    @if(!empty($getRecord->getProfilePictureUrl()))
                      <img src="{{ $getRecord->getProfilePictureUrl() }}" class="rounded-circle" style="width: 100px; height: 100px;">
                    @endif

                  </div>

                  <div class="text-center">
                
                <h1><strong>{{ strtoupper($getRecord->team_name) }}</strong></h1>
                <label >Team Name<span style="color: red;">*</span></label>
                  </div>
                
                  <div class="text-center">
               
               <h2> {{ strtoupper($getRecord->startup_name ) }}</h2> 
               <label >StartUp Name <span style="color: red;">*</span></label>
                <div style="color:red">{{ $errors->first('startup_name') }}</div>
              </div>


                  <div class="form-group col-md-">

    <label>Team Document</label>

    <br>

    @if(!empty($getRecord->team_document))

        @foreach ($getRecord->getProfileDirect1() as $documentUrl)
            <a href="{{ $documentUrl }}" target="_blank">View Document</a>
            <br>
            @if (in_array(pathinfo($documentUrl, PATHINFO_EXTENSION), ['pdf', 'docx', 'xlsx']))
                <iframe src="{{ $documentUrl }}" style="width: 100%; height: 500px;"></iframe>
            @endif
        @endforeach

    @endif

</div>


                </div>
                <!-- /.card-body -->

              </form>
             </div>
         
          </div>
          
        </div>
        
</div>
    </section>
    
    
  
  </div>


@endsection