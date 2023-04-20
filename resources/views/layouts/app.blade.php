<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    @yield('title')

  <!-- Pace loader -->
  <script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/pace_flash.css') }}">

   <!-- FAVICONS ICON -->
   <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    
    {{-- <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm/jquery-confirm.min.css') }}"> --}}
    
    @yield('styles')


</head>
<body class="layout-navbar-fixed text-sm sidebar-mini layout-fixed accent-info"> <!-- SOUND CODE -->

      <!-- Notification sound -->
    <audio id="failed">
      <source src="{{ asset('sound/failed.mp3') }}" type="audio/mpeg">
      <source src="{{ asset('sound/failed.ogg') }}" type="audio/ogg">
    </audio>
    <audio id="success">
      <source src="{{ asset('sound/success.mp3') }}" type="audio/mpeg">
      <source src="{{ asset('sound/failed.ogg') }}" type="audio/ogg">
    </audio>
    <audio id="login">
      <source src="{{ asset('sound/login.mp3') }}" type="audio/mpeg">
      <source src="{{ asset('sound/login.ogg') }}" type="audio/ogg">
    </audio>
    <script type="text/javascript">
      var failed_sound = document.getElementById("failed"); 
      var success_sound = document.getElementById("success");
      var login_sound = document.getElementById("login"); 
    </script>

  <div class="wrapper">

  

  <div class="preloader flex-column justify-content-center align-items-center" style="z-index: 99999999999">
    <img class="animation__shake" src="{{ asset('images/logo2.png') }}" alt="LfPOS" >
  </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->



        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              
              <li class="nav-item d-none d-sm-inline-block">
                
                <a href="{{route('invoices.create')}}" class="btn btn-success"> <i class="fa fa-cart-plus nav-icon"></i> New Invoice</a>
              </li>
              
              
              {{-- <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li> --}}
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Navbar Search -->
              {{-- <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                  <form class="form-inline">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li> --}}
        
              <!-- Messages Dropdown Menu -->
              {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{ asset('images/user2-160x160.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{ asset('images/user2-160x160.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          John Pierce
                          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{ asset('images/user2-160x160.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Nora Silvester
                          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li> --}}


              <!-- Notifications Dropdown Menu -->
              {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
                </a>
              </li> --}}
              
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>


            </ul>
          </nav>


       
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-success elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('images/logo.png') }}" alt="LfPOS"
                 class="brand-image  "
                 style="opacity: .8">
            <span class="brand-text font-weight-light">&nbsp;</span>
        </a>

        @include('layouts.navigation')

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    {{-- <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar --> --}}

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            &nbsp;
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ now()->format('Y') }} <a href="https://blacboykreative.com">BlacboyKrtv</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->


@yield('modals')


<!-- REQUIRED SCRIPTS -->

{{-- @vite('resources/js/app.js') --}}

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

<!-- jquery-confirm -->
{{-- <script src="{{ asset('plugins/jquery-confirm/jquery-confirm.min.js') }}"></script> --}}


@yield('scripts')


<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>


<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

<script src="{{ asset('js/script.js') }}" defer></script>

<script>
  $(document).ajaxStart(function() { Pace.restart(); }); 
</script>








</body>
</html>
