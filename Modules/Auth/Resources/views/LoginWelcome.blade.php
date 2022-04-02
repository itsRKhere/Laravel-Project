<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Logged In</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <h3 style="margin-left:1%;">Welcome, {{ Auth::user()->firstName." ".Auth::user()->lastName }}</h3>
        <a style="float:right; margin:1%; margin-right:3%;" href="{{ Route('LogoutRoute') }}">
            <button class="btn btn-primary">Log Out</button>
        </a>
    </nav>
    <div style="padding:2%;">
        Date: {{ date('d-m-Y') }}
    </div><br><br>
    @canany('isManager')
    <div class="d-flex justify-content-center">
        <a href="{{ route('tasksRoute') }}"><button class="btn btn-danger m-1">Tasks</button></a>
    </div>
    <br>
    @endcanany
    @canany('isDev')
    <div class="d-flex justify-content-center">
        <a href="{{ route('myTasksRoute') }}"><button class="btn btn-danger m-1">My Tasks</button></a>
    </div>
    <br>
    @endcanany
    <div class="d-flex justify-content-center">  
        @can('isAdmin')
        <a href="{{ route('adminRoute') }}"><button class="btn btn-danger m-1">Admin List</button></a>
        @endcan
        @canany(['isAdmin','isManager'])
        <a href="{{ route('managerRoute') }}"><button class="btn btn-success m-1">Manager List</button></a>
        @endcanany
        <a href="{{ route('devRoute') }}"><button class="btn btn-warning m-1">Developers List</button></a>
    </div>
</body>
</html>