<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Evento</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


    <!-- Template Main CSS File -->
    {{-- <link href="assets/css/style.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- =======================================================
  * Template Name: Restaurantly
  * Updated: Mar 10 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-cente">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="index.html">Evento</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#events">Events</a></li>
                    <!-- Ajout des liens de connexion et de déconnexion -->
                    @if (auth()->check())
                        <!-- Ajout des liens vers les tableaux de bord admin et organisateur -->

                        @if (Auth::user()->hasRole('admin'))
                            <li><a href="{{ route('adminDash') }}">Dashboard</a></li>
                        @endif
                        @if (Auth::user()->hasRole('organisateur'))
                            <li><a href="{{ route('organisateurDash') }}">Dashboard</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <a href="#book-a-table" class="scrollto d-none d-lg-flex"></a>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8">
                    <h1>Welcome to <span>Evento</span></h1>
                    <h2>The biggest event booking platform!</h2>
                    <h2>Creating moments to remember</h2>

                    <div class="btns">
                        <a href="#menu" class="btn-menu animated fadeInUp scrollto">Book</a>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                        <div class="about-img">
                            <img src="{{ asset('storage/event_images/' . $event->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3>{{ $event->titre }}</h3>
                        <p class="fst-italic">
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-check-circle"> Date : </i> {{ $event->date }}
                            </li>
                            <li>
                                <i class="bi bi-check-circle"> Lieu :</i> {{ $event->lieu }}
                            </li>
                            <li>
                                <i class="bi bi-check-circle"> Nombre de places total :</i> {{ $event->places }}
                            </li>
                            <li>
                                <i class="bi bi-check-circle"> Nombre de places disponibles :</i> {{ $reste }}
                            </li>
                        </ul>
                        <p>
                            {{ $event->description }}
                        </p>

                        @if ($reste > 0)
                            <div class="contact">
                                <div class="php-email-form">
                                    <div class="text-center">
                                        @auth
                                            @if (auth()->user()->hasRole('user'))
                                                <a href="{{ route('reserver',$event->id) }}"><button type="submit">Book</button></a>
                                            @else
                                                <p>Votre rôle ne vous permet pas de réserver.</p>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}"><button type="submit">Login to
                                                    Book</button></a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="contact">
                                <div class="php-email-form">
                                    <div class="text-center"><button>Places Non Disponibles !</button></div></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Restaurantly</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/restaurantly-restaurant-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>


    <!-- Template Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}

</body>

</html>
