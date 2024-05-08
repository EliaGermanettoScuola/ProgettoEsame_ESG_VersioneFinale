@extends('layouts.app')

@section('content')
    <style>
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="wrapper pt-5">
        <div class="form-container">
            <p class="title">Bentornato</p>
            @if(isset($error))
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endif
            <form id="formLogin" action="{{route('login')}}" method="POST" class="form">
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
                    <input type="email" class="form-control input" id="email" name="email" required value="{{old('email')}}" placeholder="Email">
                    <input type="password" class="form-control input" id="password" name="password" required placeholder="Password">
                    <p class="page-link">
                    <span class="page-link-label">Password dimenticata?</span>
                    </p>
                    <button type="submit" class="form-btn" >Login</button>
                </form> 
            <p class="sign-up-label">
            Non hai un account?<a class="sign-up-link" href="\PaginaRegistrazione">Registrati</a>
            </p>
        </div>

    </div>
    
    
@endsection




