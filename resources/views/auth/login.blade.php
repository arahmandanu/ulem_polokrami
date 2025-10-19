<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-light" style="font-family: 'Poppins', sans-serif;">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #fdf8f2;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px; border: none; border-radius: 12px;">
            <div class="card-body">
                <h2 class="text-center mb-4 section-title">Admin Access</h2>
                @include('flash::message')
                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" name="email" required autofocus class="form-control"
                            style="border-radius: 8px;">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" id="password" name="password" required class="form-control"
                            style="border-radius: 8px;">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-gold">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
