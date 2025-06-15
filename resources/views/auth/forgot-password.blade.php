<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HypeNews - Lupa Password</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                                <div class="p-5 d-flex flex-column justify-content-center h-100 text-center" 
                                     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <div class="text-white">
                                        <i class="fas fa-key fa-4x mb-4" style="opacity: 0.8;"></i>
                                        <h2 class="mb-3">Lupa Password?</h2>
                                        <p class="lead">Jangan khawatir, kami akan membantu Anda reset password</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4 text-muted">Masukkan email Anda dan kami akan mengirimkan link reset password!</p>
                                    </div>

                                    @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    @endif

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

                                    <form class="user" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                   name="email" placeholder="Masukkan Email Anda..." 
                                                   value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            Kirim Link Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="{{ route('register') }}">
                                            <i class="fas fa-user-plus me-1"></i>Buat Akun Baru!
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small text-decoration-none" href="{{ route('login') }}">
                                            <i class="fas fa-sign-in-alt me-1"></i>Sudah ingat password? Login!
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
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
