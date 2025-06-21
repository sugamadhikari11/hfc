<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }


        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider span {
            padding: 0 10px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #a1c4fd;
        }
    </style>
</head>
<body>
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="login-container p-5 w-100" style="max-width: 450px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Welcome Back!</h2>
            <p class="text-muted">Please login to your account</p>
            @if (session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('verified'))
                <div class="alert alert-success">
                    Your email has been verified successfully. You can now log in.
                </div>
            @endif
        </div>
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address:
                    @error('email')
                    <span class="text-danger small">{{$message}}</span>
                    @enderror
                </label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:
                    @error('password')
                    <span class="text-danger small">{{$message}}</span>
                    @enderror
                </label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-primary text-decoration-none">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Login</button>

            <div class="divider">
                <span>or continue with</span>
            </div>

            <p class="text-center mb-0">Don't have an account? <a href="{{route('register')}}"
                                                                  class="text-primary text-decoration-none">Sign
                    Up</a></p>
        </form>
    </div>
</div>
</body>
</html>
