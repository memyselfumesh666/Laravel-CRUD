<!DOCTYPE html>
<html>
<head>
    <title> Login And Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto">Laravel CRUD - Administration Control Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li> -->
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('companies.index') }}">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">Employer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
        @auth
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            @foreach ($datas as $key=>$data)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
            </tr>
            @endforeach
        </table>
        @endauth
    @yield('content')
</body>
</html>