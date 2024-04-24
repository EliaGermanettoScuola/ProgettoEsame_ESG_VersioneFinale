@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container">
            <h1>Risultati</h1>
            <p>Punteggio tipo 1: {{$punteggioTipo1}}</p>
            <p>Punteggio tipo 2: {{$punteggioTipo2}}</p>
            <p>Punteggio tipo 3: {{$punteggioTipo3}}</p>
            <p>Punteggio totale: {{$punteggiMaxTot}}</p>
        </div>
    </div>
    

@endsection