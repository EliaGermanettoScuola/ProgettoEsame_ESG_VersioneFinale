<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/function.js"></script>
    <style>
        .navbar-nav {
            flex-wrap: nowrap;
        }

        html, body {
            height: 100%;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">LOGO</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/questionario">Questionario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chi siamo</a>
                    </li>
                </ul>
                <div class="navbar-right">
                    <ul class="navbar-nav">
                        @if(session()->has('Users'))
                            <li class="nav-item">
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="nav-link"
                                            style="background:none;border:none;padding:0;">Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/loginPage">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>


    <footer class="bg-body-tertiary text-center text-lg-start mt-5">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="https://www.esgcheckup.it">esgcheckup.it</a>
        </div>
    </footer>

    
</div>
</body>
</html>


