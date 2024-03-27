
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
    <script src="{{ asset('js/functions.js') }}"></script>
</head>
<body>
    <div class="container">
        <h1>Questionario</h1>
        <!--creare il questionario prendendo le domande dalle route-->
        <div class="row">
            <div class="col-md-6">
                <!--form login-->
                <h2>Questionario</h2>
                <form id="formQuestionario" action="/questionario">
                    @csrf
                </form>
            </div>
        </div>
    </div>
<body>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/getAllQuestions',
            method: 'GET',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    response.questions.forEach(question => {
                        $('#formQuestionario').append(`
                            <div class="form-group">
                                <label>${question.domanda}</label>
                                <select class="form-control" name="question_${question.id}">
                                    <option value="">Seleziona una risposta</option>
                                    ${question.risposte.map(risposta => `<option value="${risposta}">${risposta}</option>`).join('')}
                                </select>
                            </div>
                        `);
                    });
                    $('#formQuestionario').append(`
                        <button type="submit" class="btn btn-primary">Invia</button>
                    `);
                }
            }
        });
    });
    
</script>



