@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Questionario</h1>
        <!--creare il questionario prendendo le domande dalle route-->
        <div class="row">
            <div class="col-md-6">
                <a href="/nuovoQuestionario">Nuovo questionario</a>
            </div>
        </div>
    </div>
@endsection