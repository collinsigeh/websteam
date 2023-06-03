<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    @include('layouts.favicon')
    @include('inc.social_share_snippet_1')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="custom_assets/web_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('inc.social_share_snippet_2')
    @include('inc.above_page_ad')
    
    <header>
        <a href="{{ route('welcome')}}" class="logo">PENGlobal</a>

        <input type="checkbox" name="" id="menu-bar">
        <label for="menu-bar"><i class="fas fa-bars"></i></label>

        <nav class="navbar">
            <ul>
                <li><a href="{{ route('welcome') }}">home</a></li>
                <li><a href="{{ route('about') }}">about</a></li>
                <li><a href="#">report segments <i class="fas fa-caret-down"></i></a>
                    <ul>
                        @foreach ($segments as $segment)
                        <li><a href="{{ route('segments.view', $segment->slug) }}">{{ $segment->category_name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="#">donate</a></li>
                <li><a href="{{ route('contact') }}">contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
          @yield('content')
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="text-center small">
                &copy; 2023 {{ config('app.name') }}. All rights reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>