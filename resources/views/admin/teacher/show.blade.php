@extends('layouts.app')  

@section('content')

<div class="content-wrapper">


{{--<section style="background-color: #eee;">
  <div class="container py-5 ">
    
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{ $getRecord->getProfilePictureUrl() }}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{$getRecord->name}} {{ $getRecord->last_name}}</h5>
            <p class="text-muted mb-1">{{$getRecord->id_number}}</p>
            <p class="text-muted mb-4">{{$getRecord->program}}</p>
            
          </div>
        </div>
       
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">

          <div class="row">
    <div class="col-sm-3">
        <p class="mb-0">Team Logo</p>
    </div>
    <div class="col-sm-9">
        @if ($team_logo = $getRecord->getTeamLogo())
            <img src="{{ $team_logo }}" class="rounded-circle img-fluid" style="width: 80px;" alt="Team Logo">
        @else
            <p class="text-muted mb-0">No logo available</p>
        @endif
    </div>
</div>
<hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Team Name</p>
              </div>
              <div class="col-sm-9">
              <p class="text-muted mb-0">{{$getRecord->team->team_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">StartUp Name</p>
              </div>
              <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $getRecord->getStartupName() }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$getRecord->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$getRecord->gender}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Budget</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$getRecord->budget}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mentor</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$getRecord->mentor}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{  ($getRecord->status == 0) ? 'Active' : 'Inactive' }}</p>
              </div>
            </div>
            
          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>--}}



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
                  <div class="col-6 mb-3 pl-0">
                    <h6>Team Logo</h6>
                    <p class="text-muted"> @if ($team_logo = $getRecord->getTeamLogo())
                  <img src="{{ $team_logo }}" class="rounded-circle img-fluid" style="max-width: 80px;"
                    alt="Team Logo">
                  @else
                  <p class="text-muted mb-0">No logo available</p>
                  @endif</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Team Name</h6>
                    <p class="text-muted"> @if ($getRecord && $getRecord->team)
                            <p class="text-muted mb-0">{{$getRecord->team->team_name}}</p>
                        @else
                            <p class="text-muted mb-0">Team not found</p>
                        @endif</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Email</h6>
                    <p class="text-muted">{{$getRecord->email}}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>StartUp Name</h6>
                    <p class="text-muted">{{ $getRecord->getStartupName() }}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Email</h6>
                    <p class="text-muted">{{$getRecord->email}}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Gender</h6>
                    <p class="text-muted">{{$getRecord->gender}}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Budget</h6>
                    <p class="text-muted">{{$getRecord->budget}}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Mentor</h6>
                    <p class="text-muted">{{$getRecord->mentor}}</p>
                  </div>

                  <div class="col-6 mb-3 pl-0">
                    <h6>Status</h6>
                    <p class="text-muted">{{  ($getRecord->status == 0) ? 'Active' : 'Inactive' }}</p>
                  </div>
                  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection