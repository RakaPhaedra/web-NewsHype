<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HypeNews - Daftar</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .bg-register-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }
        
        .bg-register-image::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" opacity="0.3"><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>') center/contain no-repeat;
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

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }

        .form-control:focus {
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

        .role-card {
            border: 2px solid #e3e6f0;
            border-radius: 0.5rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .role-card:hover {
            border-color: #5a5c69;
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
        }

        .role-card.selected {
            border-color: #4e73df;
            background-color: #f8f9fc;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <div class="p-5 d-flex flex-column justify-content-center h-100 text-center">
                            <div class="text-white">
                                <i class="fas fa-user-plus fa-4x mb-4" style="opacity: 0.8;"></i>
                                <h2 class="mb-3">Bergabung dengan HypeNews</h2>
                                <p class="lead">Mulai perjalanan jurnalistik Anda bersama kami</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Buat Akun Baru!</h1>
                                <p class="text-muted mb-4">Isi form di bawah untuk mendaftar</p>
                            </div>
                            
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif

                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" 
                                           name="name" placeholder="Nama Lengkap" 
                                           value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                           name="email" placeholder="Alamat Email" 
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label text-gray-700 font-weight-bold mb-3">Pilih Role Anda:</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="role-card p-3 text-center" onclick="selectRole('wartawan')">
                                                <input type="radio" name="role" value="wartawan" id="wartawan" 
                                                       {{ old('role') == 'wartawan' ? 'checked' : '' }} style="display: none;">
                                                <i class="fas fa-pen-nib fa-2x text-primary mb-2"></i>
                                                <h6 class="font-weight-bold">Wartawan</h6>
                                                <small class="text-muted">Menulis dan mengirim berita</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="role-card p-3 text-center" onclick="selectRole('editor')">
                                                <input type="radio" name="role" value="editor" id="editor" 
                                                       {{ old('role') == 'editor' ? 'checked' : '' }} style="display: none;">
                                                <i class="fas fa-edit fa-2x text-success mb-2"></i>
                                                <h6 class="font-weight-bold">Editor</h6>
                                                <small class="text-muted">Review dan publish berita</small>
                                            </div>
                                        </div>
                                    </div>
                                    @error('role')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                               name="password" placeholder="Password" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                               name="password_confirmation" placeholder="Ulangi Password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <i class="fas fa-user-plus me-2"></i>
                                    Daftar Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                    <i class="fas fa-key me-1"></i>Lupa Password?
                                </a>
                            </div>
                            <div class="text-center">
                                <a class="small text-decoration-none" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Sudah punya akun? Login!
                                </a>
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

    <script>
        function selectRole(role) {
            // Remove selected class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            event.currentTarget.classList.add('selected');
            
            // Check the radio button
            document.getElementById(role).checked = true;
        }

        // Set initial selection based on old value
        document.addEventListener('DOMContentLoaded', function() {
            const selectedRole = document.querySelector('input[name="role"]:checked');
            if (selectedRole) {
                document.querySelector(`[onclick="selectRole('${selectedRole.value}')"]`).classList.add('selected');
            }
        });
    </script>

</body>

</html>
