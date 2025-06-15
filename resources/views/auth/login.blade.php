<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HypeNews - Login</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .bg-login-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }
        
        .bg-login-image::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" opacity="0.3"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>') center/contain no-repeat;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        }

        .form-control-user {
            border-radius: 10rem;
            padding: 1.5rem 1rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }

        .form-control-user:focus {
            border-color: #5a5c69;
            box-shadow: 0 0 0 0.2rem rgba(90, 92, 105, 0.25);
        }

        .btn-user {
            border-radius: 10rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
        }

        .btn-google {
            background-color: #dd4b39;
            border-color: #dd4b39;
            color: white;
            transition: all 0.3s;
        }

        .btn-google:hover {
            background-color: #c23321;
            border-color: #c23321;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(221, 75, 57, 0.3);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e3e6f0;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #858796;
            font-size: 0.875rem;
        }

        .custom-control-label::before {
            border-radius: 0.25rem;
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="p-5 d-flex flex-column justify-content-center h-100 text-center">
                                    <div class="text-white">
                                        <i class="fas fa-newspaper fa-4x mb-4" style="opacity: 0.8;"></i>
                                        <h2 class="mb-3">HypeNews</h2>
                                        <p class="lead">Platform berita terpercaya untuk informasi terkini dan akurat</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Selamat Datang Kembali!</h1>
                                        <p class="text-muted mb-4">Silakan masuk ke akun Anda</p>
                                    </div>
                                    
                                    @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    @if(session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    <!-- Google Login Button -->
                                    <a href="{{ route('auth.google') }}" class="btn btn-google btn-user btn-block mb-3">
                                        <i class="fab fa-google fa-fw"></i>
                                        Masuk dengan Google
                                    </a>

                                    <!-- Divider -->
                                    <div class="divider">
                                        <span>atau masuk dengan email</span>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                                   name="email" placeholder="Masukkan Email Anda..." 
                                                   value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                   name="password" placeholder="Password" required>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-sign-in-alt me-2"></i>
                                            Masuk
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                            <i class="fas fa-key me-1"></i>Lupa Password?
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="{{ route('register') }}">
                                            <i class="fas fa-user-plus me-1"></i>Buat Akun Baru!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
