<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>esgcheckup</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/function.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <style>
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navBarColor navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">
                <img src="/img/logo-bianco.png" alt="logo" class="img-fluid" style="width:15vw;max-width:100px;margin-left: 25px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  d-flex justify-content-around w-100">
                <li class="nav-item text-center text-uppercase">
                    <a class="nav-link active text-white" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item text-center text-uppercase">
                    <a class="nav-link text-white" href="/questionario">Questionario</a>
                </li>
                <li class="nav-item text-center text-uppercase">
                    <a class="nav-link text-white" href="/chisiamo">Chi siamo</a>
                </li>
                @if(session()->has('Users'))
                    <li class="nav-item text-center text-uppercase">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="nav-link text-white text-uppercase">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item text-center text-uppercase">
                        <a class="nav-link text-white" href="/loginPage">Login</a>
                    </li>
                @endif
            </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</div>
</body>
</html>


