@extends('layouts.app')

@section('content')

    <div class="wrapper">
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
                                            break 2;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <input type="hidden" name="tipoCorrente" value="{{$tipoPrimaDomandaSenzaRisposta}}">
                        @foreach($questions as $tipo => $questionsPerTipo)
                            <div id="tipo-{{$tipo}}" class="border-esg p-3 mt-4 rounded ">
                                <input type="hidden" name="tipo" value="{{$tipo}}">
                                @php
                                    $letteraTipo = $tipo == 1 ? 'E' : ($tipo == 2 ? 'S' : 'G');
                                    $scrittaTipo = $tipo == 1 ? 'Environmnet' : ($tipo == 2 ? 'social' : 'Governance');
                                @endphp
                                    <label class="h3 text-1">{{$letteraTipo}}</label><label class="ps-4 h3 text-1">{{$scrittaTipo}}</label>
                                
                                
                                <div class="px-5">
                                @if($tipo != 1)
                                        <button type="button" class="btn btn-secondary hidden-content" name="precedente-{{$tipo}}" onclick="precedenteTipo()">Precedente tipo</button>
                                    @endif
                                    <hr>
                                    <div class="{{$tipo != $tipoPrimaDomandaSenzaRisposta ? 'hidden-content' : '' }}" name="content-{{$tipo}}">
                                    
                                        @foreach($questionsPerTipo as $index => $question)
                                            <form class="form-group ">
                                                <input type="hidden" name="idDomanda" value="{{$question["idDomanda"]}}">
                                                <label class="pe-2 text-1 h3">{{$index + 1}}{{$letteraTipo}}</label><label class="ms-4"><b>{{$question['domanda']}}</b></label>
                                                <div name="form-response" class="{{ $question["idDomanda"] != $idPrimaDomandaSenzaRisposta ? 'hidden-content' : '' }}" id="domanda-{{$question["idDomanda"]}}"> 
                                                    <button type="button" class="btn btn-secondary Indietro ms-5 my-3" onclick="indietro()">Indietro</button>
                                                    @foreach($question['risposte'] as $risposta)
                                                        <div class="form-check ">
                                                            <input class="form-check-input" type="radio" name="idRisposta" id="risposta-{{$risposta["idRisposta"]}}" value="{{$risposta["idRisposta"]}}" {{ isset($question['rispostaData']) && $question['rispostaData'] == $risposta["idRisposta"] ? 'checked' : '' }} >
                                                            <label class="form-check-label ms-4" for="risposta-{{$risposta["idRisposta"]}}">
                                                                {{$risposta["risposta"]}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <button type="button" class="btn color-esg Avanti ms-5 mt-3" onclick="saveAnswer()" disabled>Avanti</button>
                                                </div>
                                                <hr>
                                            </form>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                
                                <button type="button" class="btn hidden-content ms-5 color-esg" name="prossimo-{{$tipo}}" onclick="prossimoTipo()">Prossimo tipo</button>
                            </div>
                            
                        @endforeach
                        <div class="text-center pt-5">
                            <a name="calcolaRisultati" class="{{$tipoPrimaDomandaSenzaRisposta != null ? 'hidden-content' : '' }} btn btn-primary color-esg" href="{{route('calcoloFinale' , ['id' => $idQuestionnaires])}}">Calcola Risultati</a>
                        </div>
                        
                    @endif
                </div>
            @endif

        </div>
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