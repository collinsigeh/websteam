<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - {{ config('app.name') }}</title>

        <!-- Favicons -->
        @include('layouts.favicon')
        
        <link href="admin_assets/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="custom_assets/style.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-appcolor">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                                <label for="name">Name</label>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" placeholder="Enter your username" name="username" value="{{ old('username') }}" required autocomplete="username" />
                                                <label for="username">Username</label>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                                <label for="email">Email address</label>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="Create a password" name="password" required autocomplete="new-password" />
                                                        <label for="password">Password</label>

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="password-confirm" type="password" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password" />
                                                        <label for="password-confirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-appprimary btn-block">
                                                        {{ __('Create Account') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        @if (Route::has('login'))
                                            <div class="small"><a href="{{ route('login') }}">{{ __('Have an account? Go to login!') }}</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="admin_assets/js/scripts.js"></script>
    </body>
</html>
