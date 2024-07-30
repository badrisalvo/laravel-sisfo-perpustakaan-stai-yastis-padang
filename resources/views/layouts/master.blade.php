<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <title>SISFO Perpustakaan STAI Yastis Padang</title>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    @stack('styles')


</head>
<style>

    .content-backgrounds {
        background-color: #0096c7; /* Sea blue color */
        padding: 40px; /* Optional: add some padding for better readability */
    }
    .sidebar-brand {
        height: px;
    }
    .text-yellow {
        color: yellow;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        
    }
    .text-whitez {
        color: white;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        text-align: center;
        margin-left: 300px;
        -webkit-text-stroke: 1px black; /* Border hitam pada setiap huruf untuk browser berbasis WebKit */
        text-stroke: 8px black;
    }
    .text-black {
        color: black;
    }
    .btn-shadow {
        box-shadow: 10px 10px 13px rgba(0, 0, 0, 0.2); /* Add shadow for 3D effect */
        transition: all 0.2s ease; /* Smooth transition for hover effect */
        border: none; /* Remove border */
        color: black; /* Text color */
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
    }
    .btn-shadow:hover {
        box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1); /* Stronger shadow on hover */
        transform: translateY(-3px);
        color: black; 
    }

    
</style>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @yield('sidebar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @yield('topbar')
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        @yield('judul')
                    </div>

                    <div class="content-background">
                        @yield('content')
                    </div>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Cancel</button>
                                    <a href="{{ route('logout') }}" class="btn btn-outline-danger"
                                        onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->

            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tempate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('templte/js/demo/chart-area-demo.js') }}"></script>


    @stack('scripts')

    @include('sweetalert::alert')

</body>

</html>
