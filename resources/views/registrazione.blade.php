@extends('layouts.app')

@section('content')
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrazione</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('registrazione') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password2" class="form-label">Conferma Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ragioneSociale" class="form-label">Ragione Sociale</label>
                                        <input type="text" class="form-control" id="ragioneSociale" name="ragioneSociale" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="partitaIva" class="form-label">Partita IVA</label>
                                        <input type="text" class="form-control" id="partitaIva" name="partitaIva" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="codiceFiscale" class="form-label">Codice Fiscale</label>
                                        <input type="text" class="form-control" id="codiceFiscale" name="codiceFiscale" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="indirizzo" class="form-label">Indirizzo</label>
                                        <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="citta" class="form-label">Città</label>
                                        <input type="text" class="form-control" id="citta" name="citta" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cap" class="form-label">CAP</label>
                                            <input type="text" class="form-control" id="cap" name="cap" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="provincia" class="form-label">Provincia</label>
                                            <input type="text" class="form-control" id="provincia" name="provincia" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrati</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
