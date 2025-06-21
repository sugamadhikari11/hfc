<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <title>Register Page</title>
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            height: 100vh;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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


        .password-requirements ul {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="register-container p-5 w-100" style="max-width: 500px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Create Account</h2>
            <p class="text-muted">Join us today! Please fill in your details</p>
        </div>
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}">
                <div class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Account Type -->

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Create password" required>

                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>

            <div class="text-center mt-4">
                Already have an account? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Sign
                    in</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
