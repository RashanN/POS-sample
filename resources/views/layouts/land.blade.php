<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="link.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

    <link href='{{asset('https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css')}}' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    @yield('style')




    <title>Play On</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    {{-- <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> pasindurashan200@gmail.com</p>
                    <p> <i class='bx bxs-phone-call'></i>071 61 62 540</p>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">


        <div class="container">


            <a class="navbar-brand" href="#">Conscience POS System</a>


            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->




            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">


                    {{-- <li class="nav-item">
                        <a class="nav-link" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#news">News & Updates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#SportClub">Sports Club</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">Admin Panel</a>
                    </li>

                     <!-- <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>




                    <li class="nav-item">



                    </li>
                </ul>

                <!-- <a href="login.html" data-bs-toggle="modal" data-bs-target=""
                    class="btn btn-brand ms-lg-3">Log In</a> -->

                @guest
                    @if (Route::has('login'))

                    <button class="btn btn-success" type="button"
                    onClick="location.href=''">SignUp</button>

                        <button class="btn btn-warning" type="button"
                            onClick="location.href='{{ route('login') }}'">Login</button>


                    @endif
                @else
                    <li class="nav-item dropdown no-arrow btn btn-brand ms-lg-3">
                        <div class="nav-item dropdown no-arrow">
                            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                href="#">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                <a class="dropdown-item" href=""><i
                                        class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endguest
            </div>

        </div>

    </nav>

    @yield('content')

    <!-- footer -->
    <footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h4 class="navbar-brand">Developed By Conscience POS System<span class="dot">.</span></h4>
                        <div class="col-auto social-icons">
                            <a href="#"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                        </div>
                        <div class="col-auto conditions-section">
                            <a href="#">privacy</a>
                            <a href="#">terms</a>
                            <a href="#">disclaimer</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

















    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>
