@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Questionario</h1>
        <!--creare il questionario prendendo le domande dalle route-->
        <div class="row">
            <div class="col-md-6">
                <form id="formQuestionario" >
                    @csrf
                    @if(isset($error))
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endif
                    @if(isset($questions))
                        @foreach($questions as $question)
                            <div class="form-group">
                                <label>{{$question['domanda']}}</label>
                                <select class="form-control" name="question_{{$question['id']}}">
                                    <option value="">Seleziona una risposta</option>
                                    @foreach($question['risposte'] as $risposta)
                                        <option value="{{$risposta}}">{{$risposta}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Invia</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection





