@extends('layouts.app')

@section('content')

    
    <style>
        
        .hidden-content {
        display: none;
        }
    </style>
    <div class="container">
        @if(isset($error))
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
        @endif
        @if(isset($idQuestionnaires))
            <div id="questionario-{{$idQuestionnaires}}" data-tipo="1">
                @csrf
                <input type="hidden" name="idQuestionario" value="{{$idQuestionnaires}}">
                @if(isset($questions))
                    @php
                        $tipoPrimaDomandaSenzaRisposta = null;
                        $idPrimaDomandaSenzaRisposta = null;

                        if(isset($questions)) {
                            foreach($questions as $tipo => $questionsPerTipo) {
                                foreach($questionsPerTipo as $question) {
                                    if(!isset($question['rispostaData'])) {
                                        $tipoPrimaDomandaSenzaRisposta = $tipo;
                                        $idPrimaDomandaSenzaRisposta = $question['idDomanda'];
                                        break 2; // Interrompe entrambi i cicli foreach
                                    }
                                }
                            }
                        }
                    @endphp
                    <input type="hidden" name="tipoCorrente" value="{{$tipoPrimaDomandaSenzaRisposta}}">
                    @foreach($questions as $tipo => $questionsPerTipo)
                        <div id="tipo-{{$tipo}}" class="border p-3 mt-4 rounded ">
                            <input type="hidden" name="tipo" value="{{$tipo}}">
                            <h3>{{$tipo}}</h3>
                            <hr>
                            <div class="{{$tipo != $tipoPrimaDomandaSenzaRisposta ? 'hidden-content' : '' }}" name="content-{{$tipo}}">
                                @if($tipo != 1)
                                    <button type="button" class="btn btn-primary hidden-content" name="precedente-{{$tipo}}" onclick="precedenteTipo()">Precedente tipo</button>
                                @endif
                                @foreach($questionsPerTipo as $index => $question)
                                    <form class="form-group ">
                                        <input type="hidden" name="idDomanda" value="{{$question["idDomanda"]}}">
                                        <label>{{$question['domanda']}}</label>
                                        <div name="form-response" class="{{ $question["idDomanda"] != $idPrimaDomandaSenzaRisposta ? 'hidden-content' : '' }}" id="domanda-{{$question["idDomanda"]}}"> 
                                            <button type="button" class="btn btn-secondary Indietro" onclick="indietro()">Indietro</button>
                                            @foreach($question['risposte'] as $risposta)
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="idRisposta" id="risposta-{{$risposta["idRisposta"]}}" value="{{$risposta["idRisposta"]}}" {{ isset($question['rispostaData']) && $question['rispostaData'] == $risposta["idRisposta"] ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="risposta-{{$risposta["idRisposta"]}}">
                                                        {{$risposta["risposta"]}}
                                                    </label>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn btn-primary Avanti" onclick="saveAnswer()" disabled>Avanti</button>
                                        </div>
                                        <hr>
                                    </form>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary hidden-content" name="prossimo-{{$tipo}}" onclick="prossimoTipo()">Prossimo tipo</button>
                        </div>
                        
                    @endforeach
                    <a name="calcolaRisultati" class="hidden-content" href="{{route('calcoloFinale' , ['id' => $idQuestionnaires])}}">Calcola Risultati</a>
                @endif
            </div>
        @endif

    </div>


    <script>
        document.querySelectorAll('form').forEach(function(form) {
            var avantiButton = form.querySelector('.Avanti');
            if (avantiButton) {
                var checkedRadio = form.querySelector('.form-check-input:checked');
                avantiButton.disabled = !checkedRadio;
            }
        });

        document.querySelectorAll('.form-check-input').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var form = radio.closest('form');
                if (form) {
                    var avantiButton = form.querySelector('.Avanti');
                    if (avantiButton) {
                        var checkedRadio = form.querySelector('.form-check-input:checked');
                        avantiButton.disabled = !checkedRadio;
                    }
                }
            });
        });
    </script>
@endsection