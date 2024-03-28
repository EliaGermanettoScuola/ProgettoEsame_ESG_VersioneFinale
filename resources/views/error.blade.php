@extends('layouts.app')

@section('content')
    @if(!isset($error))
        @php
            $error = 'Errore sconosciuto';
        @endphp
    @endif
    <div class="container">
        <h1>Errore</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                <a href="/home">Torna alla home</a>
            </div>
        </div>
    </div>

@endsection