{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <style>
    .register-page {
      background-image: url('dist/img/');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      
    }

    .register-page::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(255, 255, 255, 0.7); /* Change the background color and the opacity here */
  
}
    
  </style>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Homework Tracker</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register </p>

      @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


      <form action="{{ route('post.register') }}" method="post">
      @include(' _message')
      @csrf

      <div class="input-group mb-3">
      <label for="user_type">Register As?:</label>
    <select name="user_type" id="user_type">
        <option value="2">Student </option>
        <option value="3">Teacher</option>
    </select>
      </div>
        <div class="input-group mb-3">
          <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <strong>Google Recapcha</strong>
          {!!  NoCaptcha::renderJs() !!}
          {!!  NoCaptcha::display() !!}
        </div>
        <div class="row">
          <div class="col-8">
          <a href="{{ url('/') }}" class="text-center">Click to Login</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html> --}}


<!doctype html>
<html lang="en">
  <head>
  	<title>Homework Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

	</head>
	<body class="img js-fullheight" style="background-image: url(frontend/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Homework Tracker</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Register your Account</h3>


            @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
		      	<form action="{{ route('post.register') }}" method="post">
              @include(' _message')
					{{ csrf_field() }}

          <div class="form-group">
            <label for="user_type">Register As:</label>
            <select name="user_type" id="user_type">
                <option value="2" {{ old('user_type') == 2 ? 'selected' : '' }}>Student</option>
                <option value="3" {{ old('user_type') == 3 ? 'selected' : '' }}>Teacher</option>
            </select>
        </div>
        

            <div class="form-group">
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"  placeholder="Name" required>
            </div>

		      		<div class="form-group">
		      			<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>

              <div class="form-group">
	              <input id="password-field" type="password" class="form-control" name="password_confirmation" id="password" placeholder="Retype Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>

              {{-- <div class="form-group">
                <strong>Google Recapcha</strong>
                {!!  NoCaptcha::renderJs() !!}
                {!!  NoCaptcha::display() !!}
              </div> --}}
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	
								<div class="w-50 ">
									<a href="{{ url('/') }}" style="color: #fff">Click to Login</a>
								</div>
                
                
	            </div>
	          </form>
      
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/css/js/popper.js') }}"></script>
  <script src="{{ asset('frontend/css/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/css/js/main.js') }}"></script>

	</body>
</html>
