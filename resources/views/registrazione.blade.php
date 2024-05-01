@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="form-container">
            <p class="title">Registrati</p>
            <form method="POST" action="{{ route('registrazione') }}" class="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <input type="email" class="form-control input" id="email" name="email" required placeholder="Email">
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control input" id="password" name="password" required placeholder="Password">
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control input" id="password2" name="password2" required placeholder="Conferma Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="ragioneSociale" name="ragioneSociale" required placeholder="RagioneSociale">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="partitaIva" name="partitaIva" required placeholder="partitaIva">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="codiceFiscale" name="codiceFiscale" required placeholder="codiceFiscale">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="indirizzo" name="indirizzo" required placeholder="indirizzo">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="citta" name="citta" required placeholder="citta">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control input" id="cap" name="cap" required placeholder="cap">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control input" id="provincia" name="provincia" required placeholder="provincia">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control input" id="telefono" name="telefono" required placeholder="telefono">
                        </div>
                    </div>
                </div>
                <button type="submit" class="form-btn" >Registrati</button>
            </form> 
        </div>
    </div>
@endsection
