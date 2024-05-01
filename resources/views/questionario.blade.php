@extends('layouts.app')

@section('content')
    <div>
        
        <div class="container">
        <h1>Questionario</h1>
            <div>
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                @endif
                @if(isset($questionnaires))
                    <div class="row">
                        @foreach($questionnaires as $questionnaire)
                            <div class="col-md-4 py-4">
                                
                                <div class="card">
                                    <input type="hidden" name="stato" value="{{$questionnaire->stato}}">
                                    <div class="card-header color-esg rounded-top">
                                        {{$questionnaire->dataInizio}} - {{$questionnaire->dataUltimoAggiornamento}}
                                    </div>
                                    <div class="card-body">
                                        
                                        <input type="hidden" name="id" value="{{$questionnaire->idQuestionario}}">
                                        
                                        @if($questionnaire->stato == 2)
                                            <p>Questionario completato</p>
                                            <a class="btn btn-primary" href="{{route('calcoloFinale' , ['id' => $questionnaire->idQuestionario])}}">Vedi risultati</a>
                                        @else
                                            <p>Questionario da finire</p>
                                            <a class="btn color-esg" href="{{route('nuovoQuestionario')}}">Continua</a>
                                            <a class="btn btn-danger" href="{{route('destroySurvey' , ['id' => $questionnaire->idQuestionario])}}">Elimina</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-4 py-4">
                            <div class="card">
                                <div class="card-header color-esg rounded-top">
                                    Crea nuovo Questionario
                                </div>
                                <div class="card-body">
                                    @if(collect($questionnaires)->contains('stato', 1))
                                        <button class="btn contain nuovoQuestionario" onclick="alertFunction()">+</button>
                                    @else
                                        <a href="/nuovoQuestionario" class="btn contain nuovoQuestionario">+</a>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                @endif
                <!--<a href="/nuovoQuestionario">Nuovo questionario</a>-->
            </div>
        </div>
    </div>
@endsection


<script>    
    function alertFunction() {
        var div = document.querySelector('input[name="stato"][value="1"]').parentElement.parentElement;
        div.classList.add('error-class');
    
        var existingP = div.querySelector('p.text-center');
        if (!existingP) {
            var p = document.createElement('p');
            p.innerHTML = 'Devi completare il questionario in corso';
            p.classList.add('text-center');
            p.style.color = 'red';
            
            div.appendChild(p);
        }
        
    }

</script>