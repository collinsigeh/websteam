<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicons -->
        @include('layouts.favicon')

        @include('inc.social_share_snippet_1')

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="/admin_assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/custom_assets/style.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    </head>
    <body class="sb-nav-fixed">
        @include('inc.social_share_snippet_2')

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('home') }}">
                <span class="d-inline-block text-truncate" style="max-width: 200px;">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!--
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
                -->
            </form>
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        -->
                        <li><a class="dropdown-item" href="{{ route('profile', Auth::user()->username) }}">My Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Contents</div>
                            
                            @if (auth()->user()->is_editor == 1)
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Categories
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{ route('categories.index') }}">All Categories</a>
                                        <a class="nav-link" href="{{ route('categories.create') }}">New Category</a>
                                    </nav>
                                </div>
                            @endif
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Posts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
                                    @if (auth()->user()->is_editor == 1 || auth()->user()->is_author == 1)
                                        <a class="nav-link" href="{{ route('posts.create') }}">New Post</a>
                                    @endif
                                </nav>
                            </div>

                            @if (auth()->user()->is_admin == 1)
                                <div class="sb-sidenav-menu-heading">Advertisements</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdverts" aria-expanded="false" aria-controls="collapseAdverts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Banner Ads
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseAdverts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{ route('banners.index') }}">All Banner Ads</a>
                                        <a class="nav-link" href="{{ route('banners.create') }}">New Banner Ad</a>
                                    </nav>
                                </div>
                            @endif
                            
                            <div class="sb-sidenav-menu-heading">More Options</div>

                            @if (auth()->user()->is_admin == 1)
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    User Accounts
                                </a>
                            @endif

                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <div class="sb-nav-link-icon"><i class="fas fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PENGlobal 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ), 
                {
                    ckfinder: 
                    {
                        uploadUrl: "{{ route('ckeditor.upload', ['_token'=>csrf_token()]) }}",
                    }
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script>
            function getImagePreview(event)
            {
                var image = URL.createObjectURL(event.target.files[0]);
                var imagediv = document.getElementById('preview');
                var newimg = document.createElement('img');
                imagediv.innerHTML = '';
                document.getElementById('upload-label').innerHTML = 'Change featured image';
                newimg.src = image;
                imagediv.appendChild(newimg);
            }

            function scheduleOption(event)
            {
                var isPublishing = document.getElementById('publish_post');
                var scheduleDiv = document.getElementById('scheduling_box');
                if(isPublishing.checked)
                {
                    scheduleDiv.style.display = 'none';
                }
                else
                {
                    scheduleDiv.style.display = 'block';
                }
            }

            function publishAtOption(event)
            {
                var isScheduling = document.getElementById('schedule_publishing');
                var publishAtDiv = document.getElementById('publish_at_box');
                if(isScheduling.checked)
                {
                    publishAtDiv.style.display = 'block';
                }
                else
                {
                    publishAtDiv.style.display = 'none';
                }
            }

            function displaySegmentOption(event)
            {
                var displayOnAllSegments = document.getElementById('display_on_allsegments');
                var displaySegmentDiv = document.getElementById('display_segments_box');
                if(displayOnAllSegments.checked)
                {
                    displaySegmentDiv.style.display = 'none';
                }
                else
                {
                    displaySegmentDiv.style.display = 'block';
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/admin_assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/admin_assets/assets/demo/chart-area-demo.js"></script>
        <script src="/admin_assets/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="/admin_assets/js/datatables-simple-demo.js"></script>
    </body>
</html>