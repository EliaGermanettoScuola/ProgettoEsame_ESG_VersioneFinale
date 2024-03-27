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