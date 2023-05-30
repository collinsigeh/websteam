<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    @include('layouts.favicon')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="custom_assets/web_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="pre-header-ad">
        
    </div>
    <header>
        <a href="{{ route('welcome')}}" class="logo">PENGlobal</a>

        <input type="checkbox" name="" id="menu-bar">
        <label for="menu-bar"><i class="fas fa-bars"></i></label>

        <nav class="navbar">
            <ul>
                <li><a href="{{ route('welcome') }}">home</a></li>
                <li><a href="{{ route('about') }}">about</a></li>
                <li><a href="#">segments +</a>
                    <ul>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Services +</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">donate</a></li>
                <li><a href="{{ route('contact') }}">contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div id="latest-post">

                    </div>
                </div>
            </div>
        </div>
        <pre>


























































        </pre>
        Hi
        <pre>




































        </pre>
        Another hi
        <pre>














        </pre>
        Last hi
    </main>
</body>
</html>