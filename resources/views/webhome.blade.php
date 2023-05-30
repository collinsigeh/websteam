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
            @if ($posts->count() > 0)
            <div id="latest-post">
                @if ($posts[0]->featured_image) 
                    <a href="{{ route('posts.view', $posts[0]->slug) }}"><img src="{{ $posts[0]->featured_image}}" alt=""></a>
                @endif
                <a href="{{ route('posts.view', $posts[0]->slug) }}"><h2>{{ $posts[0]->title }}</h2></a>
            </div>
            <div id="next-to-latest-posts">
                <div class="row">
                @php
                    $count = 0
                @endphp
                @foreach ($posts as $post)
                    @php
                        $count++;
                    @endphp
                    @if ($count > 1)
                    <div class="col-lg-4 col-md-6">
                        <div class="next-to-latest post">
                            @if ($post->featured_image)
                                <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
                            @endif
                            <a href="{{ route('posts.view', $post->slug) }}"><h5>{{ $post->title }}</h5></a>
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
            @endif

            @foreach ($post_blocks as $segment)
            @if (count($segment['posts']) > 0)
            <div class="segment-block">
                <div class="title"><span class="segment-title">{{ $segment['title'] }}</span></div>
                <div class="row">
                    @foreach ($segment['posts'] as $post)
                        <div class="col-lg-3 col-md-6">
                            <div class="block-post">
                                @if ($post->featured_image)
                                    <a href="{{ route('posts.view', $post->slug) }}"><img src="{{ $post->featured_image }}" alt=""></a>
                                @endif
                                <a href="{{ route('posts.view', $post->slug) }}">
                                    <h6>{{ $post->title }}</h6>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
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