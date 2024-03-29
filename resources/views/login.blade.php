@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Login</h2>
                <form id="formLogin" action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="e.germanetto@vallauri.edu">
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <br>
                    <button type="submit" class="btn btn-primary" >Login</button>
                </form> 

                <a href="/PaginaRegistrazione">Registrati</a>
                
            </div>
        </div>  
    </div>
    
@endsection




