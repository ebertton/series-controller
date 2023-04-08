<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series Control</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/de4afbd200.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <a class="navbar navbar-expand-lg" href="{{ route('list_series') }}">Home</a>
        @auth
            <a href="/logout" class="text-danger">Logout</a>     
        @endauth
        @guest
            <a href="/access" class="text-success">Login</a>
        @endguest
       
   </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>@yield('header')</h1>
        </div>
        @yield('content')
    </div>
</body>
</html>