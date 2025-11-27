<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="icons/favicon.png">
</head>

<body class="vh-100 d-flex justify-content-center align-items-center bg-white">

    <div class="text-center w-100">

        <h2 class="mb-4 fw-bold">LOGIN</h2>

        <div class="mx-auto p-4 rounded border" style="max-width: 450px; background: #d8cec6; border-color:#b8aea6;">

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control bg-light" autocomplete="username"
                        placeholder="Masukkan username" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control bg-light" autocomplete="current-password"
                        placeholder="Masukkan password" required>
                </div>

                <button class="btn w-40 border border-dark" style="background:#32bbff;" type="submit">Login</button>
            </form>
            @if (session('error'))
                <p style="color:red;">{{ session('error') }}</p>
            @endif
        </div>

    </div>

</body>

</html>
