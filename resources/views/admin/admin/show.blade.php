@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="" style="background-color: #f4f5f7;">
  <div class="container py-5 h-200">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-12 mb-6 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="{{ $getRecord->getProfilePictureUrl() }}"
                alt="Avatar" class="img-fluid my-5" style="width: 150px;" />
              <h5>{{$getRecord->name}} {{ $getRecord->last_name}}</h5>
              <p>{{$getRecord->id_number}}</p>
              <p>{{$getRecord->program}}</p>
            
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-12 mb-3 pl-0">
                    <h6>Email</h6>
                    <p class="text-muted">{{$getRecord->email}}</p>
                  </div>

                  <div class="row pt-1">
                  <div class="col-12 mb-3">
                    <h6>Designation</h6>
                    <p class="text-muted">{{$getRecord->designation}}</p>
                  </div>
                  
                  <div class="row pt-1">
                  <div class="col-12 mb-3 pl-3">
                    <h6>Status</h6>
                    <p class="text-muted">{{  ($getRecord->status == 0) ? 'Active' : 'Inactive' }}</p>
                  </div>
                </div>
                
                <hr class="mt-0 mb-4">
               
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>

@endsection
