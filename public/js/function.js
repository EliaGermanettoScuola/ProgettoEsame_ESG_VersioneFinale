$(document).ready(function() {
    getSession();
});



function getSession() {
$.ajax({
    url: '/getSession',
    method: 'GET',
    data: {
        type: 'Users'
    },
    success: function(response) {
        if (response.success) {
            console.log('Sessione:', response.data.Users);
        } else {
            console.log('Errore:', response.message);
        }
    }
});
}