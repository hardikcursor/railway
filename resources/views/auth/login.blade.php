<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Railways | Login</title>

    <!-- CSS Links -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/auth-light.css') }}" rel="stylesheet" />

    <style>
        body {
            background: url("{{ asset('assets/img/train.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .image-row {
            width: 100%;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .image-row img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border: 3px solid #fff;
        }

        @media (max-width: 576px) {
            .image-row {
                flex-direction: column;
                gap: 20px;
                padding: 0 10px;
            }

            .image-row img {
                width: 100px;
                height: 100px;
            }
        }

        .form-caption {
            max-width: 400px;
            margin: 20px auto 10px auto;
            padding: 10px 20px;
            background-color: rgba(210, 35, 42, 0.85);
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            border-radius: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            font-family: 'Arial', sans-serif;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.50);
            backdrop-filter: blur(10px);
            /* Glassmorphism effect */
            -webkit-backdrop-filter: blur(10px);
            /* For Safari support */
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            margin: 20px auto 40px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .railway-logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
            height: auto;
        }

        .login-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
            color: #d2232a;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-info {
            background-color: #d2232a;
            border-color: #d2232a;
        }

        .btn-info:hover {
            background-color: #a91b22;
            border-color: #a91b22;
        }

        .social-auth-hr span {
            background: white;
            padding: 0 10px;
        }

        .alert {
            max-width: 400px;
            margin: 10px auto;
        }
    </style>
</head>

<body>

    <!-- Top Image Section -->
    <div class="image-row">
        <img src="{{ asset('Backend/assets/img/modi.jpg') }}" alt="Narendra Modi">
        <img src="{{ asset('Backend/assets/img/ashwini-vaishnaw.jpg') }}" alt="Ashwini Vaishnaw">
    </div>

    <!-- Caption Above Form -->
    <div class="form-caption">
        One More Step Towards Digital India
    </div>

    <!-- Login Form Box -->
    <div class="login-box">
        <img src="{{ asset('Backend/assets/img/logo.png') }}" alt="Indian Railways Logo" class="railway-logo">

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form id="login-form" method="POST" action="{{ route('dologin') }}">
            @csrf
            <h2 class="login-title">Indian Railways Login</h2>

            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group" style="position: relative;">
                <!-- Password Input -->
                <input class="form-control" type="password" name="password" id="password" placeholder="Password">

                <!-- Eye Icon -->
                <span style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                    onclick="togglePassword()">
                    <i class="fa fa-eye" id="toggleIcon"></i>
                </span>

                <!-- Validation Error -->
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox">
                    <span class="input-span"></span>Remember me
                </label>
         
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>

            <div class="social-auth-hr text-center">
                <span>Or login with</span>
            </div>


        </form>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- JavaScript to toggle password -->
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
