
<!--template html usa boostrap-->
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
</head>
<body>
    <div class="container">
        <h1>Ciao benvenuto in home.blade.php</h1>
        <div class="row">
            <div class="col-md-6">
                <!--form login-->
                <h2>Login</h2>
                <form id="formLogin" action="/login">
                    @csrf
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="e.germanetto@vallauri.edu">
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form> 
                <!--richiamare la route get session info-->
                <button id="getSessionInfo" class="btn btn-primary">Get Session Info</button>
                <button id="getSession" class="btn btn-primary">get session</button>

                <a href="/questionario">vai al questionario</a>
            </div>
        </div>
    </div>
<body>

<script>
    //caricamento della pagina chiama get session
    $(document).ready(function() {
        getSession();
    });

    $(document).ready(function() {
        $('#getSession').on('click', function() {
            getSession();
        });
    });

    $(document).ready(function() {
        $('#getSessionInfo').on('click', function() {
            $.ajax({
                url: '/getSessionInfo',
                method: 'GET',
                success: function(response) {
                    console.log('Sessione:', response.sessionData);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        console.log('ID Utente:', response.idUtente);
                        //fai un metodo creazione della sessione
                        createSession('Users', response.idUtente);
                    } else {
                        alert(response.error);;
                    }
                }
            });
        });
    });

    function createSession(type, id) {
    $.ajax({
        url: '/createSession',
        method: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            type: type,
            id: id
        },
        success: function(response) {
            if (response.status == 'success') {
                console.log('Sessione creata:', response.data);
            } else {
                console.log('Errore:', response.message);
            }
        }
    });
}

function getSession() {
    $.ajax({
        url: '/getSession',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                console.log('Sessione:', response.data.Users);
            } else {
                console.log('Errore:', response.message);
            }
        }
    });
}

    
</script>



