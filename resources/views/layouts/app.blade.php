<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty ($header_title) ? $header_title : ''}} Homework Tracker</title>
  <link rel="icon" href="{{ asset('dist/img/Book.png') }}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset ('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset ('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset ('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset ('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset ('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    


  .document-container {
    overflow-x: auto;
}

.document-row {
    display: flex;
    flex-direction: row;
}

.document-item {
    margin-right: 20px; /* Adjust spacing between documents */
    border: 1px solid #ccc; /* Add borders to separate documents */
    padding: 10px;
}

.gradient-custom {
  /* fallback for old browsers */
  background: #87CEEB;

  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to right bottom, rgba(135, 206, 235, 1), rgba(173, 216, 230, 1));

  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to right bottom, rgba(135, 206, 235, 1), rgba(173, 216, 230, 1));
}




</style>
    @yield('style')

</head>
<body class="hold-transition layout-top-nav" >
<div class="wrapper" >

    @include('layouts.header')
    <div class="content-wrapper " style="margin-left: 0;">


      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      
      <script>
        $(document).ready(function() {
        $('#myTable').DataTable({
          "lengthChange": false, // Disable "Show X entries"
          "paging": false // Disable pagination
        });
      });
      </script>
      <!-- Apply Stacktable to the table with ID 'myTable' -->
      <script>
        // Function to redirect to the logout URL
        function logout() {
            window.location.href = "{{ url('logout') }}";
        }
    
        // Function to check session timeout
        function checkSessionTimeout() {
        // Set the timeout duration in seconds (1 minute)
        var timeoutDuration = 1800;
    
            // Start a timer to check session timeout
            var timer = setInterval(function () {
                // Check if the user is still logged in (you can customize this based on your authentication setup)
                var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    
                if (!isLoggedIn) {
                    // User is not logged in, stop the timer
                    clearInterval(timer);
                }
    
                // Decrement the timeout duration
                timeoutDuration--;
    
                // Check if the timeout duration has reached zero
                if (timeoutDuration <= 0) {
                    // Session timeout reached, logout the user
                    logout();
                }
            }, 1000); // Check every second
        }
    
        // Call the checkSessionTimeout function when the page is loaded
        $(document).ready(function () {
            checkSessionTimeout();
        });
    </script>

    @yield('content')
    @include('layouts.footer')
  
</div>


<!-- jQuery -->
<script src="{{ asset ('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset ('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset ('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset ('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset ('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset ('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset ('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset ('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset ('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset ('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset ('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset ('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('dist/js/adminlte.js') }}"></script>
<script src="{{ asset ('dist/js/pages/dashboard.js') }}"></script> 
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

@yield('script')

</body>
</html>
