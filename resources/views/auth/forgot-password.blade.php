<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Railways | Forgot Password</title>

    <!-- CSS Links -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages/auth-light.css') }}" rel="stylesheet">

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
            flex-wrap: wrap;
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
                justify-content: space-between;
                padding: 0 20px;
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
        }

        .login-box {
            background: rgba(255, 255, 255, 0.50);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
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

        .forgot-password-link {
            font-size: 14px;
            color: #d2232a;
            text-decoration: none;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
            color: #a91b22;
        }

        .btn-railway {
            background-color: #d2232a;
            /* Railway red */
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-railway:hover {
            background-color: #a91b22;
            /* Darker red on hover */
        }
    </style>
</head>

<body>

    <!-- Top Officials -->
    <div class="image-row">
        <img src="{{ asset('Backend/assets/img/modi.jpg') }}" alt="Narendra Modi">
        <img src="{{ asset('Backend/assets/img/ashwini-vaishnaw.jpg') }}" alt="Ashwini Vaishnaw">
    </div>

    <!-- Caption -->
    <div class="form-caption">One More Step Towards Digital India</div>

    <!-- Forgot Password Box -->
    <div class="login-box">
        <img src="{{ asset('Backend/assets/img/logo.png') }}" alt="Indian Railways Logo" class="railway-logo">

        <h2 class="login-title">Forgot Password</h2>

        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form action="{{ route('forget.password.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email_address" class="form-label">Enter Email Address</label>
                <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger small">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-railway">
                    Send Password Reset Link
                </button>
            </div>

        </form>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
