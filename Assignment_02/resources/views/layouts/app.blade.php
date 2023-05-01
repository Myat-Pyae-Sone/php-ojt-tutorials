<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student data</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <header class="header bg-light row">
        <div class="col-5 offset-2">
            <h5>Navbar</h5>
        </div>
        <div class="col-3 offset-2">
            <a href="{{ route('student.list') }}" class='text-decoration-none text-dark'>Students</a>
            <a href="{{ route('major.list') }}" class='text-decoration-none text-dark'>Majors</a>
        </div>
    </header>
    @yield('content')
</body>

</html>
