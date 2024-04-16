$(document).ready(function() {
    getSession();
});

function getSession() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '/getSession',
            method: 'GET',
            data: {
                type: 'Users'
            },
            success: function(response) {
                if (response.success) {
                    console.log('Sessione:', response.data.Users);
                    resolve(response.data.Users);
                } else {
                    console.log('Errore:', response.message);
                    resolve(null);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject(errorThrown);
            }
        });
    });
}


function saveAnswer(){

    var form = document.activeElement.form;
    var idQuestionario = document.querySelector('[name="idQuestionario"]').value;
    var tipo = document.querySelector('[name="tipo"]').value;
    var formData = $(form).serialize();
    formData += '&idQuestionario=' + idQuestionario + '&tipo=' + tipo;
    console.log(formData);


    $.ajax({
        url: '/saveAnswer',
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                console.log('Risposta salvata:', response.data);
                
                avanti(form);
            } else {
                console.log('Errore:', response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Errore:', errorThrown);
        }
    });
}

function avanti(form){

    var formResponse = form.querySelector('[name="form-response"]');
    var nextForm = form.nextElementSibling;
    console.log('nextForm:', nextForm)
    if (nextForm != null) {
        formResponse.classList.add('hidden-content');
        var nextFormResponse = nextForm.querySelector('[name="form-response"]');
        nextFormResponse.classList.remove('hidden-content');
    } else {
        var tipoCorrente = document.querySelector('[name="tipoCorrente"]').value;
        console.log('tipoCorrente:', tipoCorrente)
        if(tipoCorrente == '3'){
            var calcolaRisultato = document.querySelector('[name="calcolaRisultati"]');
            calcolaRisultato.classList.remove('hidden-content');

        }
        else{
            var prossimoTipo = document.querySelector('[name="prossimo-' + tipoCorrente + '"]');
            console.log('prossimoTipo:', prossimoTipo)
            prossimoTipo.classList.remove('hidden-content');
        }
        
    }

}

function indietro(){
    var form = document.activeElement.form;
    var prevForm = form.previousElementSibling;
    var tipoCorrente = document.querySelector('[name="tipoCorrente"]').value;
    var prossimoTipo = document.querySelector('[name="prossimo-' + tipoCorrente + '"]');
    console.log('prevForm:', prevForm)
    if (prevForm) {
        if(prevForm.getAttribute('name') == "precedente-" + tipoCorrente + ""){
            prevForm.classList.remove('hidden-content');
        }else{
            var prevFormResponse = prevForm.querySelector('[name="form-response"]');
            console.log('prevFormResponse:', prevFormResponse)
            prevFormResponse.classList.remove('hidden-content');

            var formResponse = form.querySelector('[name="form-response"]');
            formResponse.classList.add('hidden-content');

            prossimoTipo.classList.add('hidden-content');
        }
        
    }
}

function prossimoTipo(){
    console.log('prossimoTipo');
    var tipo = document.querySelector('[name="tipoCorrente"]').value;
    var courrentTipo = document.querySelector('[name="content-' + tipo + '"]');
    var nextTipo = document.querySelector('[name="content-' + (parseInt(tipo) + 1) + '"]');
    if (nextTipo) {
        courrentTipo.classList.add('hidden-content');
        nextTipo.classList.remove('hidden-content');
        document.querySelector('[name="tipoCorrente"]').value = (parseInt(tipo) + 1).toString();
        //quando vai al prossimo tipo prendi il primo form di quel tipo
        var formResponse = nextTipo.querySelector('[name="form-response"]');
        formResponse.classList.remove('hidden-content');
    } 
}

function precedenteTipo(){
    console.log('precedenteTipo');
    var tipo = document.querySelector('[name="tipoCorrente"]').value;
    console.log('tipo:', tipo)
    var courrentTipo = document.querySelector('[name="content-' + tipo + '"]');
    var prevTipo = document.querySelector('[name="content-' + (parseInt(tipo) - 1) + '"]');
    console.log('courrentTipo:', courrentTipo)
    console.log('prevTipo:', prevTipo)

    if (prevTipo) {
        courrentTipo.classList.add('hidden-content');
        prevTipo.classList.remove('hidden-content');
        document.querySelector('[name="tipoCorrente"]').value = (parseInt(tipo) - 1).toString();
        //quando vai al prossimo tipo prendi l'ultimo elemento del form di quel tipo
        var formResponses = prevTipo.querySelectorAll('[name="form-response"]');
        var lastFormResponse = formResponses[formResponses.length - 1];
        lastFormResponse.classList.remove('hidden-content');

    } 
}









