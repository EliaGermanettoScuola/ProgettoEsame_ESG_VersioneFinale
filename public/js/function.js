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
    var questionario = document.getElementById('questionario-' + idQuestionario);
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
                
                avanti(form,questionario);
            } else {
                console.log('Errore:', response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Errore:', errorThrown);
        }
    });
}

function avanti(form,questionario){

    var formResponse = form.querySelector('[name="form-response"]');
    var nextForm = form.nextElementSibling;
    if (nextForm) {
        formResponse.classList.add('hidden-content');
        var nextFormResponse = nextForm.querySelector('[name="form-response"]');
        nextFormResponse.classList.remove('hidden-content');
    } else {
        tipoCorrente = questionario.getAttribute('data-tipo');
        if(tipoCorrente == '3'){
            var calcolaRisultato = document.querySelector('[name="calcolaRisultati"]');
            calcolaRisultato.classList.remove('hidden-content');

        }
        else{
            var prossimoTipo = document.querySelector('[name="prossimo-' + tipoCorrente + '"]');
            prossimoTipo.classList.remove('hidden-content');
        }
        
    }

}

function indietro(){
    var form = document.activeElement.form;
    var prevForm = form.previousElementSibling;
    var prossimoTipo = document.querySelector('[name="prossimo"]');
    if (prevForm) {
        var prevFormResponse = prevForm.querySelector('[name="form-response"]');
        prevFormResponse.classList.remove('hidden-content');

        var formResponse = form.querySelector('[name="form-response"]');
        formResponse.classList.add('hidden-content');

        prossimoTipo.classList.add('hidden-content');
    }
}

function prossimoTipo(){
    console.log('prossimoTipo');
    var idQuestionario = document.querySelector('[name="idQuestionario"]').value;
    var questionario = document.getElementById('questionario-' + idQuestionario);
    var tipo = questionario.getAttribute('data-tipo');
    var courrentTipo = document.querySelector('[name="content-' + tipo + '"]');
    var nextTipo = document.querySelector('[name="content-' + (parseInt(tipo) + 1) + '"]');
    if (nextTipo) {
        courrentTipo.classList.add('hidden-content');
        nextTipo.classList.remove('hidden-content');
        questionario.setAttribute('data-tipo', (parseInt(tipo) + 1).toString());
    } 
}

function precedenteTipo(){
    console.log('precedenteTipo');
    var idQuestionario = document.querySelector('[name="idQuestionario"]').value;
    var questionario = document.getElementById('questionario-' + idQuestionario);
    var tipo = questionario.getAttribute('data-tipo');
    console.log('tipo:', tipo)
    var courrentTipo = document.querySelector('[name="content-' + tipo + '"]');
    var prevTipo = document.querySelector('[name="content-' + (parseInt(tipo) - 1) + '"]');
    console.log('courrentTipo:', courrentTipo)
    console.log('prevTipo:', prevTipo)

    if (prevTipo) {
        courrentTipo.classList.add('hidden-content');
        prevTipo.classList.remove('hidden-content');
        questionario.setAttribute('data-tipo', (parseInt(tipo) - 1).toString());
    } 
}









