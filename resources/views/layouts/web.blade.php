<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PENGlobal Associates Limited</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  @include('layouts.favicon')

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="web_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="web_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="web_assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="web_assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="web_assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="web_assets/css/variables.css" rel="stylesheet">
  <link href="web_assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PencilBlog.
  * Updated: May 15 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/pencilblog-bootstrap-blog-template/
  * Author: Briigo.com
  * License: https:///briigo.com/license/
  ======================================================== -->
</head>

<body>
  
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>PENGlobal</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('welcome') }}">HOME</a></li>
          <li><a href="{{ route('about') }}">ABOUT</a></li>
          <li class="dropdown"><a href="#"><span>SEGMENTS</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @foreach ($segments as $segment)
                <li><a href="{{ route('segments.view', $segment->slug) }}">{{ $segment->category_name }}</a></li>
              @endforeach
            </ul>
          </li>

          <li><a href="#">DONATE</a></li>
          <li><a href="{{ route('contact') }}">CONTACT</a></li>
          <li>
            <a href="{{ route('login') }}" style="background-color: #ED7B43; color: #ffffff; padding: 6px 21px; margin-left: 20px; margin-right: 20px; border-radius: 4px;">
            @guest
              LOGIN
            @endguest
            @auth
              DASHBOARD
            @endauth
            </a>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>PENGlobal Associates Ltd</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- Designed by <a href="https://briigo.com/">Briigo Digital</a> -->
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="web_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="web_assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="web_assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="web_assets/vendor/aos/aos.js"></script>
  <script src="web_assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="web_assets/js/main.js"></script>

</body>

</html>