
<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
  <div class="container">
    <div class="brand-link">
      <img src="{{ asset('dist/img/Book.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Homework Tracker</span>
  </div>

      <!-- Toggler/collapsible Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
              <!-- Your navigation items here -->

              @if(Auth::user()->user_type == 1)

         <li class="nav-item">
          
            <a href="{{ url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">
             
              <p>
                Dashboard
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin')active @endif">
              
              <p>
                Admin
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) == 'teacher')active @endif">
             
              <p>
                Teacher
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/student/list')}}" class="nav-link @if(Request::segment(2) == 'student')active @endif">
              
              <p>
                Student
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{ url('admin/class/list')}}" class="nav-link @if(Request::segment(2) == 'class')active @endif">
             
              <p>
                Section
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject')active @endif">
             
              <p>
                Subject
              </p>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Assign
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item @if(Request::segment(2) == 'assign_subject')active @endif" href="{{ url('admin/assign_subject/list')}}">
                Assign Subject
              </a>
              <a class="dropdown-item @if(Request::segment(2) == 'assign_class_teacher')active @endif" href="{{ url('admin/assign_class_teacher/list')}}">
                Assign Section Teacher
              </a>
            </div>
          </li>
          

          
          <li class="nav-item">
            <a href="{{ url('admin/homework/list')}}" class="nav-link @if(Request::segment(2) == 'homework')active @endif">
              
              <p>
                Homework
              </p>
            </a>
          </li>

       




          @elseif(Auth::user()->user_type == 3)

          <li class="nav-item">
     
       <a href="{{ url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">

         <p>
           Dashboard
         
         </p>
       </a>
     </li>

     <li class="nav-item">
     
       <a href="{{ url('teacher/my_student')}}" class="nav-link @if(Request::segment(2) == 'my_student')active @endif">
        
         <p>
           My Student
         
         </p>
       </a>
     </li>

     <li class="nav-item">
     
       <a href="{{ url('teacher/my_class_subject')}}" class="nav-link @if(Request::segment(2) == 'my_class_subject')active @endif">
       
         <p>
           My Section & Subject
         
         </p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('teacher/homework/list')}}" class="nav-link @if(Request::segment(2) == 'homework')active @endif">
         
         <p>
           Homework
         </p>
       </a>
     </li>


     

    @elseif(Auth::user()->user_type == 2)

    <li class="nav-item">
       <a href="{{ url('student/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
        
         <p>
           Dashboard
           
         </p>
       </a>
     </li>


     <li class="nav-item">
       <a href="{{ url('student/my_subject')}}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
        
         <p>
          My Subject
           
         </p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('student/my_homework')}}" class="nav-link @if(Request::segment(2) == 'my_homework') active @endif">
        
         <p>
          My Homework
           
         </p>
       </a>
     </li>

     <li class="nav-item">
     <a href="{{ url('student/my_submitted_homework')}}" class="nav-link @if(Request::segment(2) == 'my_submitted_homework') active @endif">
   
       <p>
        Submitted Homework
         
       </p>
     </a>
   </li>

     
   

    @endif
     </ul>
     <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img style="height: 40px; width: 40px;" src="{{  Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                      {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="{{ url
                      (Auth::user()->user_type == 1 ? 'admin/account' : (Auth::user()->user_type == 2 ? 'student/account' :
                       'teacher/account')) }}">My Account</a>
                      <a class="dropdown-item" href="{{ url(Auth::user()->user_type == 1 ? 'admin/change_password' : (Auth::user()->user_type == 2 ? 'student/change_password' : 'teacher/change_password')) }}">Change Password</a>
                      <a class="dropdown-item" href="{{ url('logout')}}">Logout</a>
                  </div>
              </li>
          </ul>
      </div>
  </div>
</nav>
