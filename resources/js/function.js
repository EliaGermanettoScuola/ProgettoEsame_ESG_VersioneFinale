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