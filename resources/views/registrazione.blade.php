@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="form-container">
            <p class="title">Registrati</p>
            <form method="POST" action="{{ route('registrazione') }}" class="form">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <input type="email" class="form-control input" id="email" name="email" required placeholder="Email" value="{{old('email')}}">
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control input" id="password" name="password" required placeholder="Password" >
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control input" id="password2" name="password2" required placeholder="Conferma Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="ragioneSociale" name="ragioneSociale" required placeholder="RagioneSociale" value="{{old('ragioneSociale')}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="partitaIva" name="partitaIva" required placeholder="partitaIva" value="{{old('partitaIva')}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="codiceFiscale" name="codiceFiscale" required placeholder="codiceFiscale" value="{{old('codiceFiscale')}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="indirizzo" name="indirizzo" required placeholder="indirizzo" value="{{old('indirizzo')}}"> 
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="citta" name="citta" required placeholder="citta" value="{{old('citta')}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control input" id="cap" name="cap" required placeholder="cap" value="{{old('cap')}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control input" id="provincia" name="provincia" required placeholder="provincia" value="{{old('provincia')}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="telefono" name="telefono" required placeholder="telefono" value="{{old('telefono')}}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="form-btn" >Registrati</button>
            </form> 
        </div>
    </div>
@endsection
