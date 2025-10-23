<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yarnly - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Yarnly</a>
            <div>
                @if(auth()->check())
                    <span class="me-2">Hello, {{ auth()->user()->name }}!</span>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to Yarnly!</h1>
        <p>Browse our site freely, or create an account to save your favorites and interact with content.</p>
    </div>
</body>
</html>
