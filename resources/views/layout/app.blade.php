<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Form</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/logout') }}">Logout</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
