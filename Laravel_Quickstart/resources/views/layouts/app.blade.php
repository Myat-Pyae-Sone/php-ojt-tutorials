<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel QuickStart</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
</head>

<body>
    <div class="container border border-1 bg-light p-2 mt-3 w-75">
        <nav class="nav-bar">
            Task List
        </nav>
    </div>
    @yield('content')
</body>

</html>
